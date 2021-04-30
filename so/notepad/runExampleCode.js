$('#editor').trumbowyg({
    btnsDef: {
        alert: {
            fn: function() {
                alert(document.getElementById('editor').innerHTML);
            },
            ico: 'upload'
        }
    },
    btns: [
        ['alert'],
		['strong', 'em', 'del'],
		['superscript', 'subscript'],
		['link'],
		['unorderedList', 'orderedList', 'horizontalRule', 'formatting', 'removeformat' ],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull']
    ]
});