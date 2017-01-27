$(".remove-user").click(function () {
    var userId = $(this).attr('userid');
    swal({
            title: "Você tem certeza?",
            text: "Que deseja remover esse usuário?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, remover!",
            closeOnConfirm: false
        },
        function () {
            $.get("/user/remove/" + userId, function () {
                swal({title: "", text:"Usuário deletado com sucesso", type:"success"}, function () {
                    window.location.href = "/home";
                });
            });
        });
});