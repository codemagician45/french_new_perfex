<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>XML-RPC for PHP</title><link rel="stylesheet" href="xmlrpc.css" type="text/css" /><meta name="generator" content="DocBook XSL Stylesheets V1.74.3" /><link rel="home" href="index.html" title="XML-RPC for PHP" /><link rel="next" href="ch01.html" title="Chapter 1. Introduction" /></head><body><div class="navheader"><table width="100%" summary="Navigation header"><tr><th colspan="3" align="center">XML-RPC for PHP</th></tr><tr><td width="20%" align="left"> </td><th width="60%" align="center"> </th><td width="20%" align="right"> <a accesskey="n" href="ch01.html">Next</a></td></tr></table><hr /></div><div class="book" lang="en" xml:lang="en"><div class="titlepage"><div><div><h1 class="title"><a id="id530463"></a>XML-RPC for PHP</h1></div><div><h2 class="subtitle">version 2.2.2</h2></div><div><div class="authorgroup"><div class="author"><h3 class="author"><span class="firstname">Edd</span> <span class="surname">Dumbill</span></h3></div><div class="author"><h3 class="author"><span class="firstname">Gaetano</span> <span class="surname">Giunta</span></h3></div><div class="author"><h3 class="author"><span class="firstname">Miles</span> <span class="surname">Lott</span></h3></div><div class="author"><h3 class="author"><span class="firstname">Justin R.</span> <span class="surname">Miller</span></h3></div><div class="author"><h3 class="author"><span class="firstname">Andres</span> <span class="surname">Salomon</span></h3></div></div></div><div><p class="copyright">Copyright © 1999,2000,2001 Edd Dumbill, Useful Information Company</p></div><div><div class="legalnotice"><a id="id530557"></a><p>All rights reserved.</p><p>Redistribution and use in source and binary forms, with or without
      modification, are permitted provided that the following conditions are
      met:</p><div class="itemizedlist"><ul type="disc"><li><p>Redistributions of source code must retain the above
            copyright notice, this list of conditions and the following
            disclaimer.</p></li><li><p>Redistributions in binary form must reproduce the above
            copyright notice, this list of conditions and the following
            disclaimer in the documentation and/or other materials provided
            with the distribution.</p></li><li><p>Neither the name of the "XML-RPC for PHP" nor the names of
            its contributors may be used to endorse or promote products
            derived from this software without specific prior written
            permission.</p></li></ul></div><p>THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND
      CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING,
      BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
      FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
      REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
      SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
      TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
      PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
      LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
      NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
      SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.</p></div></div></div><hr /></div><div class="toc"><p><b>Table of Contents</b></p><dl><dt><span class="chapter"><a href="ch01.html">1. Introduction</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch01.html#id530427">Acknowledgements</a></span></dt></dl></dd><dt><span class="chapter"><a href="ch02.html">2. What's new</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch02.html#id530725">2.2.2</a></span></dt><dt><span class="sect1"><a href="ch02s02.html">2.2.1</a></span></dt><dt><span class="sect1"><a href="ch02s03.html">2.2</a></span></dt><dt><span class="sect1"><a href="ch02s04.html">2.1</a></span></dt><dt><span class="sect1"><a href="ch02s05.html">2.0 final</a></span></dt><dt><span class="sect1"><a href="ch02s06.html">2.0 Release candidate 3</a></span></dt><dt><span class="sect1"><a href="ch02s07.html">2.0 Release candidate 2</a></span></dt><dt><span class="sect1"><a href="ch02s08.html">2.0 Release candidate 1</a></span></dt></dl></dd><dt><span class="chapter"><a href="ch03.html">3. System Requirements</a></span></dt><dt><span class="chapter"><a href="ch04.html">4. Files in the distribution</a></span></dt><dt><span class="chapter"><a href="ch05.html">5. Known bugs and limitations</a></span></dt><dt><span class="chapter"><a href="ch06.html">6. Support</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch06.html#id532511">Online Support</a></span></dt><dt><span class="sect1"><a href="ch06s02.html">The Jellyfish Book</a></span></dt></dl></dd><dt><span class="chapter"><a href="ch07.html">7. Class documentation</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch07.html#xmlrpcval">xmlrpcval</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch07.html#id532737">Notes on types</a></span></dt><dt><span class="sect2"><a href="ch07.html#xmlrpcval-creation">Creation</a></span></dt><dt><span class="sect2"><a href="ch07.html#xmlrpcval-methods">Methods</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch07s02.html">xmlrpcmsg</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch07s02.html#id533915">Creation</a></span></dt><dt><span class="sect2"><a href="ch07s02.html#id534023">Methods</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch07s03.html">xmlrpc_client</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch07s03.html#id534351">Creation</a></span></dt><dt><span class="sect2"><a href="ch07s03.html#id534519">Methods</a></span></dt><dt><span class="sect2"><a href="ch07s03.html#id535945">Variables</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch07s04.html">xmlrpcresp</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch07s04.html#id536087">Creation</a></span></dt><dt><span class="sect2"><a href="ch07s04.html#id536184">Methods</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch07s05.html">xmlrpc_server</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch07s05.html#id536404">Method handler functions</a></span></dt><dt><span class="sect2"><a href="ch07s05.html#id536497">The dispatch map</a></span></dt><dt><span class="sect2"><a href="ch07s05.html#signatures">Method signatures</a></span></dt><dt><span class="sect2"><a href="ch07s05.html#id536731">Delaying the server response</a></span></dt><dt><span class="sect2"><a href="ch07s05.html#id536813">Modifying the server behaviour</a></span></dt><dt><span class="sect2"><a href="ch07s05.html#id536919">Fault reporting</a></span></dt><dt><span class="sect2"><a href="ch07s05.html#id537184">'New style' servers</a></span></dt></dl></dd></dl></dd><dt><span class="chapter"><a href="ch08.html">8. Global variables</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch08.html#id537293">"Constant" variables</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch08.html#id537299">$xmlrpcerruser</a></span></dt><dt><span class="sect2"><a href="ch08.html#id537324">$xmlrpcI4, $xmlrpcInt, $xmlrpcBoolean, $xmlrpcDouble,
        $xmlrpcString, $xmlrpcDateTime, $xmlrpcBase64, $xmlrpcArray,
        $xmlrpcStruct, $xmlrpcValue, $xmlrpcNull</a></span></dt><dt><span class="sect2"><a href="ch08.html#id537349">$xmlrpcTypes, $xmlrpc_valid_parents, $xmlrpcerr, $xmlrpcstr,
        $xmlrpcerrxml, $xmlrpc_backslash, $_xh, $xml_iso88591_Entities,
        $xmlEntities, $xmlrpcs_capabilities</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch08s02.html">Variables whose value can be modified</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch08s02.html#xmlrpc-defencoding">xmlrpc_defencoding</a></span></dt><dt><span class="sect2"><a href="ch08s02.html#id537432">xmlrpc_internalencoding</a></span></dt><dt><span class="sect2"><a href="ch08s02.html#id537504">xmlrpcName</a></span></dt><dt><span class="sect2"><a href="ch08s02.html#id537530">xmlrpcVersion</a></span></dt><dt><span class="sect2"><a href="ch08s02.html#id537557">xmlrpc_null_extension</a></span></dt></dl></dd></dl></dd><dt><span class="chapter"><a href="ch09.html">9. Helper functions</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch09.html#id537600">Date functions</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch09.html#iso8601encode">iso8601_encode</a></span></dt><dt><span class="sect2"><a href="ch09.html#iso8601decode">iso8601_decode</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch09s02.html">Easy use with nested PHP values</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch09s02.html#phpxmlrpcdecode">php_xmlrpc_decode</a></span></dt><dt><span class="sect2"><a href="ch09s02.html#phpxmlrpcencode">php_xmlrpc_encode</a></span></dt><dt><span class="sect2"><a href="ch09s02.html#id538134">php_xmlrpc_decode_xml</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch09s03.html">Automatic conversion of php functions into xmlrpc methods (and
      vice versa)</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch09s03.html#id538228">wrap_xmlrpc_method</a></span></dt><dt><span class="sect2"><a href="ch09s03.html#wrap_php_function">wrap_php_function</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch09s04.html">Functions removed from the library</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch09s04.html#xmlrpcdecode">xmlrpc_decode</a></span></dt><dt><span class="sect2"><a href="ch09s04.html#xmlrpcencode">xmlrpc_encode</a></span></dt></dl></dd><dt><span class="sect1"><a href="ch09s05.html">Debugging aids</a></span></dt><dd><dl><dt><span class="sect2"><a href="ch09s05.html#id538826">xmlrpc_debugmsg</a></span></dt></dl></dd></dl></dd><dt><span class="chapter"><a href="ch10.html">10. Reserved methods</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch10.html#id538930">system.getCapabilities</a></span></dt><dt><span class="sect1"><a href="ch10s02.html">system.listMethods</a></span></dt><dt><span class="sect1"><a href="ch10s03.html">system.methodSignature</a></span></dt><dt><span class="sect1"><a href="ch10s04.html">system.methodHelp</a></span></dt><dt><span class="sect1"><a href="ch10s05.html">system.multicall</a></span></dt></dl></dd><dt><span class="chapter"><a href="ch11.html">11. Examples</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch11.html#statename">XML-RPC client: state name query</a></span></dt><dt><span class="sect1"><a href="ch11s02.html">Executing a multicall call</a></span></dt></dl></dd><dt><span class="chapter"><a href="ch12.html">12. Frequently Asked Questions</a></span></dt><dd><dl><dt><span class="sect1"><a href="ch12.html#id539177">How to send custom XML as payload of a method call</a></span></dt><dt><span class="sect1"><a href="ch12s02.html">Is there any limitation on the size of the requests / responses
      that can be successfully sent?</a></span></dt><dt><span class="sect1"><a href="ch12s03.html">My server (client) returns an error whenever the client (server)
      returns accented characters</a></span></dt><dt><span class="sect1"><a href="ch12s04.html">My php error log is getting full of "deprecated" errors on
      different lines of xmlrpc.inc and xmlrpcs.inc</a></span></dt><dt><span class="sect1"><a href="ch12s05.html">How to enable long-lasting method calls</a></span></dt><dt><span class="sect1"><a href="ch12s06.html">My client returns "XML-RPC Fault #2: Invalid return payload:
      enable debugging to examine incoming payload": what should I do?</a></span></dt><dt><span class="sect1"><a href="ch12s07.html">How can I save to a file the xml of the xmlrpc responses received
      from servers?</a></span></dt><dt><span class="sect1"><a href="ch12s08.html">Can I use the ms windows character set?</a></span></dt><dt><span class="sect1"><a href="ch12s09.html">Does the library support using cookies / http sessions?</a></span></dt></dl></dd><dt><span class="appendix"><a href="apa.html">A. Integration with the PHP xmlrpc extension</a></span></dt><dt><span class="appendix"><a href="apb.html">B. Substitution of the PHP xmlrpc extension</a></span></dt><dt><span class="appendix"><a href="apc.html">C. 'Enough of xmlrpcvals!': new style library usage</a></span></dt><dt><span class="appendix"><a href="apd.html">D. Usage of the debugger</a></span></dt></dl></div></div><div class="navfooter"><hr /><table width="100%" summary="Navigation footer"><tr><td width="40%" align="left"> </td><td width="20%" align="center"> </td><td width="40%" align="right"> <a accesskey="n" href="ch01.html">Next</a></td></tr><tr><td width="40%" align="left" valign="top"> </td><td width="20%" align="center"> </td><td width="40%" align="right" valign="top"> Chapter 1. Introduction</td></tr></table></div></body></html>