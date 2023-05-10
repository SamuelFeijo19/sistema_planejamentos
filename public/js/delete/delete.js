$(document).on('click', '.delete', function (e) {
    //CONFIRMAÇÃO DE EXCLUSÃO
    Swal.fire({
        title: 'Tem certeza que deseja excluir?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!'
    }).then((result) => {
        if (result.isConfirmed) {
            //EXCLUSÃO
            $.ajax({
                url: $(this).data('route'),
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data)
                    Swal.fire(
                        'Excluído!',
                        'Seu arquivo foi excluído.',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.reload()
                    }, 2000)
                },
                error: function (data) {
                    Swal.fire(
                        'Erro!',
                        'Não foi possível excluir o arquivo.',
                        'error'
                    )
                }
            })
        }
    })
})
