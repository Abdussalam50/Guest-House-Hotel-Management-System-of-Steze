<script src="../crud/sweetalert2@11.js"></script>
<script src="../crud/jquery-3.6.0.min.js"></script>


<script>
    function crud(select, tableName) {
        if (select.value === '__tambah') {
            crud_sweetalert(tableName);

            // Reset pilihan kembali ke default setelah dibuka
            setTimeout(() => {
                select.value = '';
            }, 300);
        }
    }
</script>

<script>
    function crud_sweetalert(tableName) {
        const formatTitle = (name) => {
            name = name.replace(/^data_/, '');
            return name.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
        };

        const displayTitle = formatTitle(tableName);



        Swal.fire({
            title: displayTitle,
            html: '<div id="crudContainer">Loading...</div>',
            showCloseButton: true,
            showConfirmButton: false,
            didOpen: () => {
                loadData();
            },
            willClose: () => {
                // Refresh halaman saat window ditutup
                location.reload();
            }
        });


        function loadData() {
            $.get("../crud/crud_handler.php", {
                table: tableName,
                action: "read"
            }, function(res) {
                $('#crudContainer').html(res);
                bindEvents();
            });
        }

        function bindEvents() {
            // ADD ROW
            $('#addRow').click(function() {
                var formData = {};
                $('.input-new').each(function() {
                    var name = $(this).attr('name');
                    var value = $(this).val();
                    formData[name] = value;
                });
                formData['action'] = 'create';
                formData['table'] = tableName;

                $.post("../crud/crud_handler.php", formData, function() {
                    loadData();
                });
            });

            // UPDATE
            $('.saveRow').click(function() {
                var row = $(this).closest('tr');
                var id = row.data('id');
                var formData = {
                    action: 'update',
                    table: tableName,
                    id: id
                };
                row.find('input').each(function() {
                    formData[$(this).attr('name')] = $(this).val();
                });

                $.post("../crud/crud_handler.php", formData, function() {
                    loadData();
                });
            });

            // DELETE
            $('.deleteRow').click(function() {
                var id = $(this).data('id');
                if (confirm("Yakin ingin menghapus data ini?")) {
                    $.post("../crud/crud_handler.php", {
                        action: 'delete',
                        table: tableName,
                        id: id
                    }, function() {
                        loadData();
                    });
                }
            });
        }
    }
</script>