<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Estimate extends ClientsController
{
    public function index($id, $hash)
    {
        check_estimate_restrictions($id, $hash);
        $estimate = $this->estimates_model->get($id);

        if (!is_client_logged_in()) {
            load_client_language($estimate->clientid);
        }

        $identity_confirmation_enabled = get_option('estimate_accept_identity_confirmation');

        if ($this->input->post('estimate_action')) {
            $action = $this->input->post('estimate_action');
            // Only decline and accept allowed
            if ($action == 4 || $action == 3) {
                $success = $this->estimates_model->mark_action_status($action, $id, true);

                $redURL   = $this->uri->uri_string();
                $accepted = false;
                if (is_array($success) && $success['invoiced'] == true) {
                    $accepted = true;
                    $invoice  = $this->invoices_model->get($success['invoiceid']);
                    set_alert('success', _l('clients_estimate_invoiced_successfully'));
                    $redURL = site_url('invoice/' . $invoice->id . '/' . $invoice->hash);
                } elseif (is_array($success) && $success['invoiced'] == false || $success === true) {
                    if ($action == 4) {
                        $accepted = true;
                        set_alert('success', _l('clients_estimate_accepted_not_invoiced'));
                    } else {
                        set_alert('success', _l('clients_estimate_declined'));
                    }
                } else {
                    set_alert('warning', _l('clients_estimate_failed_action'));
                }
                if ($action == 4 && $accepted = true) {
                    process_digital_signature_image($this->input->post('signature', false), ESTIMATE_ATTACHMENTS_FOLDER . $id);

                    $this->db->where('id', $id);
                    $this->db->update(db_prefix() . 'estimates', get_acceptance_info_array());
                }
            }
            redirect($redURL);
        }
        // Handle Estimate PDF generator
        if ($this->input->post('estimatepdf')) {
            try {
                $pdf = estimate_pdf($estimate);
            } catch (Exception $e) {
                echo $e->getMessage();
                die;
            }

            $estimate_number = format_estimate_number($estimate->id);
            $companyname     = get_option('invoice_company_name');
            if ($companyname != '') {
                $estimate_number .= '-' . mb_strtoupper(slug_it($companyname), 'UTF-8');
            }

            $filename = hooks()->apply_filters('customers_area_download_estimate_filename', mb_strtoupper(slug_it($estimate_number), 'UTF-8') . '.pdf', $estimate);

            $pdf->Output($filename, 'D');
            die();
        }
        $this->load->library('app_number_to_word', [
            'clientid' => $estimate->clientid,
        ], 'numberword');

        $this->app_scripts->theme('sticky-js', 'assets/plugins/sticky/sticky.js');

        $data['title'] = format_estimate_number($estimate->id);
        $this->disableNavigation();
        $this->disableSubMenu();
        $data['hash']                          = $hash;
        $data['can_be_accepted']               = false;
        $data['estimate']                      = hooks()->apply_filters('estimate_html_pdf_data', $estimate);
        $data['bodyclass']                     = 'viewestimate';
        $data['identity_confirmation_enabled'] = $identity_confirmation_enabled;
        if ($identity_confirmation_enabled == '1') {
            $data['bodyclass'] .= ' identity-confirmation';
        }
        $this->data($data);
        $this->view('estimatehtml');
        add_views_tracking('estimate', $id);
        hooks()->do_action('estimate_html_viewed', $id);
        no_index_customers_area();
        $this->layout();
    }

    public function universign_get_url($id, $hash)
    {
       
        include(APPPATH."libraries/universign/params.inc.php");
        include(APPPATH."libraries/universign/lib/xmlrpc.inc");

        $GLOBALS['xmlrpc_internalencoding']='UTF-8';
        //Read the document and delete the temporary file
        $doc_content = null;
        $doc_name = null;

        if ($_FILES['document']['size'] == 0) {
            //no document, use the default one
            $doc_name="default-contract.pdf";
            $doc_content=file_get_contents($doc_name);

        } else {
            $doc_filename=$_FILES['document']['tmp_name'];
            $doc_content=file_get_contents($doc_filename);
            $doc_name=basename($_FILES['document']['name']);
            if (is_uploaded_file($doc_filename)) {
                unlink($doc_filename);
            }
        }
        
        //retrieve the return url
        // $returnPage = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        // $returnPage .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . dirname($_SERVER["REQUEST_URI"]);
        $returnPage = base_url('estimate/universign_return/'.$id.'/'.$hash);
        $returnPage .= "/?id=";

        $redirectTo = $_REQUEST['redirectTo'].'/universign_return/'.$id.'/'.$hash;

        //create the request
        $c = new xmlrpc_client($uni_url);
        $signer = array(
            "firstname" => new xmlrpcval(trim($_REQUEST["acceptance_firstname"]), "string"),
            "lastname" => new xmlrpcval(trim($_REQUEST["acceptance_lastname"]), "string"),
            // the return urls
            "successURL" =>  new xmlrpcval($returnPage."success", "string"),
            "failURL" =>  new xmlrpcval($returnPage."fail", "string"),
            "cancelURL" =>  new xmlrpcval($returnPage."cancel", "string"),
            // position of the signature field
            "signatureField" => new xmlrpcval(array(
                "page" => new xmlrpcval(1, "int"),
                "x" => new xmlrpcval(50, "int"),
                "y" => new xmlrpcval(10, "int")
            ), "struct")
        );
        
        if ($_REQUEST["acceptance_email"] != null) {
            $signer["emailAddress"] = new xmlrpcval($_REQUEST["acceptance_email"], "string");
        }

        $language = "fr";
        if (isset($_REQUEST["language"])&&$_REQUEST["language"] != null) {
            $language = $_REQUEST["language"];
        }

        if (isset($_REQUEST["profile"])&&$_REQUEST["profile"] != null) {
            $uni_profile = $_REQUEST["profile"];
        }

        if (isset($_REQUEST["redirectTo"])&&$_REQUEST["redirectTo"] != null) {
            // $_SESSION['uni_redirectTo'] =  $redirectTo;
            $_SESSION['uni_redirectTo'] =  $_REQUEST["redirectTo"];
        }
        $hand = 0;
        if (isset($_REQUEST["hand"]) && $_REQUEST["hand"] == "on" ) {
            $hand = 1;
        }
        if (isset($_REQUEST["estimate_action"]) && $_REQUEST["estimate_action"] != null ) {
            $_SESSION['action'] = $_REQUEST['estimate_action'];
        }
        $_REQUEST['certType'] = 'simple';
        // print_r($_SESSION); exit();
        $request = array(
            "documents" => new xmlrpcval(array(
                //array of documents to sign
                new xmlrpcval(array(
                    "content" => new xmlrpcval($doc_content, "base64"),     
                    "name" => new xmlrpcval($doc_name, "string")        
                ), "struct")
            ), "array"),
            "signers" =>  new xmlrpcval(array(
                new xmlrpcval($signer, "struct"),
            ), "array"),
            //handwritten
            "handwrittenSignature" =>  new xmlrpcval($hand, "boolean"),
            // the profile to use
            "profile" =>  new xmlrpcval($uni_profile, "string"),
            //the types of acceptected certificate : all | on-the-fly | local
            "certificateType" =>  new xmlrpcval($_REQUEST["certType"], "string"),
            "language" => new xmlrpcval($language, "string")
        );

        $f = new xmlrpcmsg('requester.requestTransaction', array(new xmlrpcval($request, "struct")));

        //SSL verification (should be enabled in production)
        $c->setSSLVerifyHost(1);
        $c->setSSLVerifyPeer(1);

        //Debug flag
        $c->setDebug(0);

        //Send request an analyse response
        $r=&$c->send($f);
        if(!$r->faultCode()) {
            //request successul: store the ID in the session and redirects to the URL
            $url = $r->value()->structMem('url')->scalarVal();
            $_SESSION['uni_id'] = $r->value()->structMem('id')->scalarVal();
            header("Location: ".$url);
        } else {
            //error
            print "An error occurred: ";
            print "Code: " . $r->faultCode()
                . " Reason: '" . $r->faultString();
        }
    }

    public function universign_return($id,$hash)
    {
        
        if ($_SESSION['uni_redirectTo'] != null) {
            header("Location: ".$_SESSION['uni_redirectTo']."?id=".$_REQUEST['id']);
            unset($_SESSION['uni_redirectTo']);
        }
        // if ($_REQUEST["id"] == "success") {
        //     $action = $_SESSION['action'];
        //     // Only decline and accept allowed
        //     if ($action == 4 || $action == 3) {
        //         $success = $this->estimates_model->mark_action_status($action, $id, true);

        //         // $redURL   = $this->uri->uri_string();
        //         $redURL   = $_SESSION['uni_redirectTo'];
        //         $accepted = false;
        //         if (is_array($success) && $success['invoiced'] == true) {
        //             $accepted = true;
        //             $invoice  = $this->invoices_model->get($success['invoiceid']);
        //             set_alert('success', _l('clients_estimate_invoiced_successfully'));
        //             $redURL = site_url('invoice/' . $invoice->id . '/' . $invoice->hash);
        //         } elseif (is_array($success) && $success['invoiced'] == false || $success === true) {
        //             if ($action == 4) {
        //                 $accepted = true;
        //                 set_alert('success', _l('clients_estimate_accepted_not_invoiced'));
        //             } else {
        //                 set_alert('success', _l('clients_estimate_declined'));
        //             }
        //         } else {
        //             set_alert('warning', _l('clients_estimate_failed_action'));
        //         }
        //         if ($action == 4 && $accepted = true) {
        //             // process_digital_signature_image($this->input->post('signature', false), ESTIMATE_ATTACHMENTS_FOLDER . $id);

        //             $this->db->where('id', $id);
        //             $this->db->update(db_prefix() . 'estimates', get_acceptance_info_array());
        //         }
        //     }
        // }
        
        // if the request is not successful
        if ($_REQUEST["id"] != "success") {
            return;
        }

        include(APPPATH."libraries/universign/params.inc.php");
        include(APPPATH."libraries/universign/lib/xmlrpc.inc");

        //create the request
        $c=new xmlrpc_client($uni_url);
        $f=new xmlrpcmsg(
            'requester.getDocumentsByTransactionId',
            array(
                new xmlrpcval($_SESSION['uni_id'], "string")        
            )
        );

        //SSL verification (should be enabled in production)
        $c->setSSLVerifyHost(0);
        $c->setSSLVerifyPeer(0);

        //Debug flag
        $c->setDebug(0);


        //Send request an analyse response
        $r=&$c->send($f);
        unset($_SESSION['uni_id']);
        if(!$r->faultCode()) {
            $r =  $r->value();
            for ($i = 0; $i < $r->arraySize(); $i++)
            {
                //store the signed documents in the session
                $docs[$i]['name'] = $r->arrayMem($i)->structMem('name')->scalarVal();
                $docs[$i]['content'] = $r->arrayMem($i)->structMem('content')->scalarVal();
                $_SESSION['signed_documents'] = $docs;
            }
        } else {
            print "An error occurred: ";
            print "Code: " . $r->faultCode()
                . " Reason: '" . $r->faultString();
        }
        // print_r($_SESSION); exit(); 
    }

    public function download_pdf($id,$hash)
    {
        $doc = $_SESSION['signed_documents'][0];
        print_r($_SESSION); exit();
        //Retrieve the document
        header("Pragma: no-cache");
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=" . $doc['name']);
        header("Content-Length: " . strlen($doc['content']));
        ob_clean();
        flush();
        print $doc['content'];
    }
}
