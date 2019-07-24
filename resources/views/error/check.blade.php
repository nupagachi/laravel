<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Page Not Found :(</title>
</head>
<body>
<div class="container">


    <section name="role" id="role" class="browser-default custom-select">
        @foreach(\Illuminate\Support\Facades\Config::get('rules.rule') as $value=> $key)
            <option  value="{{ $key }}">
                {{ $value }}
            </option>
        @endforeach
    </section>


    <form runat="server">
        <input type='file' id="imgInp"/>
        <img id="blah" src="#" alt="your image"/>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    </script>
</div>
</body>
</html>
