<script>
    $(document).ready(function() {
        $.noConflict();
        var token = ''
        var modal = $('.modal')
        var form = $('.form')
        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update');

        var table = $('#customers').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            aaSorting: [
                [0, "desc"]
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'dob',
                    name: 'dob'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        btnAdd.click(function() {
            modal.modal()
            form.trigger('reset')
            modal.find('.modal-title').text('Add New Record')
            btnSave.show();
            btnUpdate.hide()
        })

        btnSave.click(function(e) {
            e.preventDefault();
            var data = form.serialize()
            console.log(data)
            $.ajax({
                type: "POST",
                url: "",
                data: data + '&_token=' + token,
                success: function(data) {
                    if (data.success) {
                        table.draw();
                        form.trigger("reset");
                        modal.modal('hide');
                    } else {
                        alert('Delete Fail');
                    }
                }
            }); //end ajax
        })


        $(document).on('click', '.btn-edit', function() {
            btnSave.hide();
            btnUpdate.show();


            modal.find('.modal-title').text('Update Record')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData = table.row($(this).parents('tr')).data()

            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="name"]').val(rowData.name)
            form.find('input[name="phone"]').val(rowData.phone)
            form.find('input[name="dob"]').val(rowData.dob)

            modal.modal()
        })

        btnUpdate.click(function() {
            if (!confirm("Are you sure?")) return;
            var formData = form.serialize() + '&_method=PUT&_token=' + token
            var updateId = form.find('input[name="id"]').val()
            $.ajax({
                type: "POST",
                url: "/" + updateId,
                data: formData,
                success: function(data) {
                    if (data.success) {
                        table.draw();
                        modal.modal('hide');
                    }
                }
            }); //end ajax
        })


        $(document).on('click', '.btn-delete', function() {
            if (!confirm("Are you sure?")) return;

            var rowid = $(this).data('rowid')
            var el = $(this)
            if (!rowid) return;


            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "/" + rowid,
                data: {
                    _method: 'delete',
                    _token: token
                },
                success: function(data) {
                    if (data.success) {
                        table.row(el.parents('tr'))
                            .remove()
                            .draw();
                    }
                }
            }); //end ajax
        })
    })
</script>
