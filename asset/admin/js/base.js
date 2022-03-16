$(document).ready(function () {

    var obj = $('#content');
    if (obj.find('[name=action]').val() !== 'update') {
        var table = obj.find('[name=addDetail]').closest('table');
        var tbody = table.find('tbody');
        var tr = tbody.find('tr');
        var clone = $(tr[0]).clone(true);
        $(tbody).append(clone);
        $(tr[0]).hide();
    }
    obj.find('.closeDetail').click(function () {
        var tbody = $(this).closest('tbody');
        var tr = tbody.find('tr');
        if (tr.length != 1) {
            $(this).closest('tr').remove();
        }
    })
    obj.find('[name=addDetail]').click(function () {
        console.log('jalan')
        var table = $(this).closest('table');
        var tbody = table.find('tbody');
        var tr = tbody.find('tr');
        var clone = $(tr[0]).clone(true);
        $(tbody).append(clone);
        var newObj = $(this).closest('table').find('tbody');
        $(newObj.find('tr')[tr.length]).show();
    });

});


