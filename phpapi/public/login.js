$('#loginForm').on('submit', function (e) {
    e.preventDefault();

    $('#loginError').hide();

    $.ajax({
        url: '/login',
        type: 'POST',
        method: 'POST',
        data: $(this).serialize(),
        beforeSend: function () {
            $('button[type=submit]').text('Validando...');
        },
        success: function (response, textStatus, xhr) {
            if (xhr.status === 200) {
                window.location.href = 'dashboard.php';
            } else {
                $('#loginError').text('Usuário ou senha inválidos.').show();
                $('button[type=submit]').text('Entrar');
            }
        },
        // complete: function(xhr, textStatus) {
        //     console.log(xhr.status);
        // }, 
        error: function () {
            $('#loginError').text('Erro ao conectar com o servidor.').show();
            $('button[type=submit]').text('Entrar');
        }
    });
});