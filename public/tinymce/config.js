

tinymce.init({
    selector: "textarea#short-desc",
	theme: "silver",
	height: 300,
	plugins: [
        // "advlist autolink link image media filemanager code responsivefilemanager"
        ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker"],
        ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
        ["save table directionality emoticons template paste"]
	],
	// toolbar1: "undo redo | bold italic underline | forecolor backcolor | responsivefilemanager | link unlink | image media | code | alignleft aligncenter alignright alignjustify|",
    toolbar2: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
    image_advtab: true,
	external_filemanager_path: baseUrl + "/file/",
    filemanager_title: "Thư viện ảnh",
    filemanager_access_key: akey ,
	external_plugins: {
		// "responsivefilemanager": baseUrl+"/tinymce/plugins/responsivefilemanager/plugin.min.js",
		"filemanager": baseUrl+"/file/plugin.min.js"
	},
});

tinymce.init({
    selector: "textarea#desc",
	theme: "silver",
	height: 300,
	plugins: [
        // "advlist autolink link image media filemanager code responsivefilemanager"
        ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker"],
        ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
        ["save table directionality emoticons template paste"]
	],
    // toolbar1: "undo redo | bold italic underline | forecolor backcolor | responsivefilemanager | link unlink | image media | code",
    toolbar2: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
	// toolbar2: "",
	image_advtab: true,
	external_filemanager_path: baseUrl + "/file/",
    filemanager_title: "Thư viện ảnh",
    filemanager_access_key: akey ,
	external_plugins: {
		// "responsivefilemanager": baseUrl+"/tinymce/plugins/responsivefilemanager/plugin.min.js",
		"filemanager": baseUrl+"/file/plugin.min.js"
	},
});

tinymce.init({
    selector: "textarea.config",
	theme: "silver",
	height: 300,
	plugins: [
        // "advlist autolink link image media filemanager code responsivefilemanager"
        ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker"],
        ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
        ["save table directionality emoticons template paste"]
	],
    // toolbar1: "undo redo | bold italic underline | forecolor backcolor | responsivefilemanager | link unlink | image media | code",
    toolbar2: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
	// toolbar2: "",
	image_advtab: true,
	external_filemanager_path: baseUrl + "/file/",
    filemanager_title: "Thư viện ảnh",
    filemanager_access_key: akey ,
	external_plugins: {
		// "responsivefilemanager": baseUrl+"/tinymce/plugins/responsivefilemanager/plugin.min.js",
		"filemanager": baseUrl+"/file/plugin.min.js"
	},
});




