@component('mail::message')
# Novo Formulário de Contato Recebido

Você recebeu um novo formulário de contato com as seguintes informações:

- **Nome:** {{ $formData['name'] }}
- **Email:** {{ $formData['email'] }}
- **Assunto:** {{ $formData['subject'] }}
- **Telefone:** {{ $formData['phone'] ?? 'N/A' }}

**Mensagem:**
{{ $formData['message'] }}

Obrigado,<br>
{{ config('app.name') }}
@endcomponent