/*
 * jQuery Iframe Transport Plugin v9.12.3
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2011, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):window.jQuery)}(function(a){"use strict";var b=0;a.ajaxTransport("iframe",function(c){if(c.async){var e,f,g,d=c.initialIframeSrc||"javascript:false;";return{send:function(h,i){e=a('<form style="display:none;"></form>'),e.attr("accept-charset",c.formAcceptCharset),g=/\?/.test(c.url)?"&":"?","DELETE"===c.type?(c.url=c.url+g+"_method=DELETE",c.type="POST"):"PUT"===c.type?(c.url=c.url+g+"_method=PUT",c.type="POST"):"PATCH"===c.type&&(c.url=c.url+g+"_method=PATCH",c.type="POST"),b+=1,f=a('<iframe src="'+d+'" name="iframe-transport-'+b+'"></iframe>').bind("load",function(){var b,g=a.isArray(c.paramName)?c.paramName:[c.paramName];f.unbind("load").bind("load",function(){var b;try{if(b=f.contents(),!b.length||!b[0].firstChild)throw new Error}catch(c){b=void 0}i(200,"success",{iframe:b}),a('<iframe src="'+d+'"></iframe>').appendTo(e),window.setTimeout(function(){e.remove()},0)}),e.prop("target",f.prop("name")).prop("action",c.url).prop("method",c.type),c.formData&&a.each(c.formData,function(b,c){a('<input type="hidden"/>').prop("name",c.name).val(c.value).appendTo(e)}),c.fileInput&&c.fileInput.length&&"POST"===c.type&&(b=c.fileInput.clone(),c.fileInput.after(function(a){return b[a]}),c.paramName&&c.fileInput.each(function(b){a(this).prop("name",g[b]||c.paramName)}),e.append(c.fileInput).prop("enctype","multipart/form-data").prop("encoding","multipart/form-data"),c.fileInput.removeAttr("form")),e.submit(),b&&b.length&&c.fileInput.each(function(c,d){var e=a(b[c]);a(d).prop("name",e.prop("name")).attr("form",e.attr("form")),e.replaceWith(d)})}),e.append(f).appendTo(document.body)},abort:function(){f&&f.unbind("load").prop("src",d),e&&e.remove()}}}}),a.ajaxSetup({converters:{"iframe text":function(b){return b&&a(b[0].body).text()},"iframe json":function(b){return b&&a.parseJSON(a(b[0].body).text())},"iframe html":function(b){return b&&a(b[0].body).html()},"iframe xml":function(b){var c=b&&b[0];return c&&a.isXMLDoc(c)?c:a.parseXML(c.XMLDocument&&c.XMLDocument.xml||a(c.body).html())},"iframe script":function(b){return b&&a.globalEval(a(b[0].body).text())}}})});
