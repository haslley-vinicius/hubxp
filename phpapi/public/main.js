function carregarProdutos(pagina = 1, busca = '') {
    $('#loading').show();
    $.ajax({
        url: '/products',
        type: 'GET',
        // data: { page: pagina, search: busca },
        data: { page: pagina, search: busca },
        success: function (data) {
            data = data.includes("}]") ? JSON.parse(data) : data;
            contData = `<table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
                </tr>
            </thead>
            <tbody>`;

            if (typeof data === "object") {
                if (data.length > 0) {
                    data.forEach((el, idx) => {
                        contData += `<tr>
                        <td>${el.id}</td>
                        <td>${el.name}</td>
                        <td>R$ ${el.price}</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-btn" data-id="${el.id}">Editar</button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="${el.id}">Excluir</button>
                        </td>
                        </tr>`
                    })

                    $('#btn-del-all').removeClass("disabled");
                } else {
                    $('#btn-del-all').addClass("disabled");
                }
            } else {
                $('#btn-del-all').addClass("disabled");
            }

            contData += `</tbody>
            </table>
            `;

            $('#productTable').html(contData);
        },
        complete: function () {
            $('#loading').hide();
        }
    });
}

$(document).on('click', '.pagination .page-link', function (e) {
    e.preventDefault();
    const pagina = $(this).data('page');
    if (pagina) {
        carregarProdutos(pagina, termoBusca);
    }
});

$(document).ready(function () {
    carregarProdutos();

    $('#search').on('keyup', function () {
        let termo = $(this).val();
        carregarProdutos(1, termo);
    });

    // Criação
    $('#createForm').submit(function (e) {
        e.preventDefault();
        frmData = $(this).serializeArray();

        var formData = new FormData();
        formData.append('name', frmData[0].value);
        formData.append('price', frmData[1].value);

        $.ajax({
            url: '/products',
            type: 'POST',
            // data: {
            //     name: frmData[0].value,
            //     price: frmData[1].value
            // },
            data: formData,
            processData: false,
            contentType: false,
            success: function (res, textStatus, xhr) {
                $('#createModal').modal('hide');
                if (res.includes('successfully')) {
                    location.reload();
                } else {
                    $('#listError').text(res).show();
                }
                // carregarProdutos();
            },
            error: function () {
                alert('Erro ao criar produto.');
            }
        });
    });

    // Editar (preenche o modal)
    $(document).on('click', '.edit-btn', function () {
        let id = $(this).data('id');

        $.get(`/products/${id}`, function (produto) {
            $('#editId').val(produto.id);
            $('#editNome').val(produto.name);
            $('#editPreco').val(produto.price);
            $('#editModal').modal('show');
        }, 'json');
    });

    // Deletar (preenche o modal)
    $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');

        if (confirm(`DESEJA DELETAR O PRODUTO ID: ${id}?`) == true) {
            $.ajax({
                url: `/products/${id}`,
                type: 'DELETE',
                method: 'DELETE',
                contentType: 'application/json',
                success: function (response, textStatus, xhr) {
                    if (response.includes('successfully')) {
                        location.reload();
                    } else {
                        $('#listError').text(response).show();
                    }
                },
                error: function (response) { //request,msg,error
                    $('#listError').text(response).show();
                }
            });
        }
    });

    $('#btn-del-all').on('click', function () {
        if (confirm(`DESEJA DELETAR TODOS OS PRODUTOS?`) == true) {
            $.ajax({
                url: `/products/delete-all`,
                type: 'DELETE',
                method: 'DELETE',
                success: function (response, textStatus, xhr) {
                    if (response.includes('successfully')) {
                        location.reload();
                    } else {
                        $('#listError').text(response).show();
                    }
                },
                error: function (response) { //request,msg,error
                    $('#listError').text(response).show();
                }
            });
        }
    });

    $('#btn-logout').on('click', function () {
        if (confirm(`DESEJA REALMENTE SAIR?`) == true) {
            $.ajax({
                url: `/logout`,
                type: 'GET',
                method: 'GET',
                success: function (response, textStatus, xhr) {
                    if (response.includes('successfully')) {
                        location.reload();
                    }
                }
            });
        }
    });

    $('#editForm').submit(function (e) {
        e.preventDefault();

        frmData = $(this).serializeArray();

        id = frmData[0].value;
        
        contData = {
                "name": frmData[1].value,
                "price": frmData[2].value
            };

        $.ajax({
            url: `/products/${id}`,
            type: 'PUT',
            data: JSON.stringify(contData),
            contentType: 'application/json',
            success: function (res) {
                $('#editModal').modal('hide');

                if (res.includes('successfully')) {
                    location.reload();
                } else {
                    $('#listError').text(res).show();
                }
                // carregarProdutos();
            },
            error: function (response) { //request,msg,error
                $('#listError').text(response).show();
            }
        });
    });

});