//初始化
if ('ontouchstart' in document.documentElement) {
    document.addEventListener('touchmove', function (e) { e.preventDefault(); });
}
//jQuery初始化 
$(function () {
    var listLength = localStorage.length;
    var $saveBtn = $('#saveBtn');
    var $show = $('#show');
    var $list = $('#list');
    var $new = $('#new');
    var $del = $('#del');

    //自动定位页面焦点 
    $('#addNote').live('pageshow', function () { $('#textarea').focus(); });

    function save() {
        var $inputVal = $('#textarea').val();
        localStorage.setItem('note' + (listLength + 1), $inputVal);
        $('.ui-dialog').dialog('close');

        //偷懒
        setTimeout(function () { location.reload() }, 100);

    }

    function noteList() {

        if (listLength > 0) {
            var listLi = '';
            for (var i = 1; i <= listLength; i++) {
                listLi += '<li><a href="#"><h3>备忘-' + i + '</h3><p>' + localStorage['note' + i] + '&nbsp;</p></a></li>';
            }
            $list.append(listLi).listview('refresh');
        } else {

        }

    }
    noteList();

    function show(e) {
        $('#viewNote > div[data-role="header"] > h1').html($(this).find('h3').html());
        $('#viewNote > div[data-role="content"]').html($(this).find('p').html());
        $.mobile.changePage('#viewNote', {});
    }

    function newNote() {
        $.mobile.changePage('#addNote', {});
    }

    $saveBtn.bind('vclick', save);
    $new.bind('vclick', newNote);
    $list.find('a').bind('vclick', show);
    $del.bind('vclick', function (event) {
        event.preventDefault();
        var info = window.confirm('确定要清空所有的备忘吗？');
        if (info) {
            localStorage.clear();
        }
        location.reload();
    });



    //PhoneGap初始化 
    document.addEventListener('deviceready', onDeviceReady, false);

    function onDeviceReady() { }


});


