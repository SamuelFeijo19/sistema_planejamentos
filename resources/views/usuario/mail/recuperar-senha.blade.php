<x-mail::message>
    <h1>Recuperar Senha</h1>
    Você pode redefinir a senha no link abaixo:
    <a href="{{route('mail-resetar-senha', $token)}}">Redefinir senha</a>
</x-mail::message>
