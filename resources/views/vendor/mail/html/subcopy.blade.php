<tr>
    <td class="header">
        <a>
            {{-- {{ $slot }} --}}
            <img src="https://www.lokkl.com/assets/img/logo.png" alt="" width="120px">
        </a>
    </td>
</tr>

<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td>
            {{ Illuminate\Mail\Markdown::parse($slot) }}
        </td>
    </tr>
</table>