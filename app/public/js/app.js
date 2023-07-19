$(document).ready(function() {
    const table = new DataTable('#data', {
        lengthMenu: [
            [3, 10, 25],
            [3, 10, 25]
        ],
        ajax: {
            url: '/api/v1/get',
            type: 'POST',
        },
        columns: [
            {
                data: 'id',
                orderable: false,
                visible: false
            },
            {
                data: 'name',
                orderable: true
            },
            {
                data: 'email',
                orderable: true
            },
            {
                data: 'text',
                orderable: false
            },
            {
                data: 'done',
                render: data => (data === 'true' ? 'Done' : 'To do'),
                defaultContent: 'To do',
                orderable: true
            },
            {
                data: null,
                render: data => isLogged ? '<a href="/edit/' + data.id + '"><i class="row-edit fa fa-lg fa-pencil-square"></i></a>' : '<i class="row-edit disabled fa fa-lg fa-pencil-square" style="color: #999999"></i>',
                orderable: false,
                // visible: isLogged
                visible: true
            }
        ],
        dom: 'Bfrtip',
        order: [1, 'asc'],
        processing: true,
        serverSide: true
    });
});