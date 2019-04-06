<div class="container float-right">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-dark">
                <form name="myForm" id="myForm">
                    <div><label for="user-name">Name: </label><input type="text" name="name" id="user-name" class="float-right" /></div>
                    <div><label for="user-email">Email: </label><input type="text" name="email" id="user-email" class="float-right" /></div>
                    <div><label for="user-firm">Firm: </label><input type="text" name="firm" id="user-firm" class="float-right" /></div>
                    <div><label for="user-tara">Tara: </label><input type="text" name="tara" id="user-tara" class="float-right" /></div>
                    <button onclick="flushAll()" class="btn btn-light" type="button"> Submit </button>
            </div>
        </div>
    </div>
</div>
<script>

    function flushAll() {
        let userData = {
            name: $('#user-name').val(),
            email: $('#user-email').val(),
            firm: $('#user-firm').val(),
            tara: $('#user-tara').val()
        };
        $.ajax({
            url: 'createUser',
            method: 'POST',
            data: userData,
            success: (data) => {console.log(data);}
            })
    }
</script>