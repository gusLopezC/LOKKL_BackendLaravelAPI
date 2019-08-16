{{-- <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="center">
                        
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table> --}}

<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
    <tr>
        <td>
            <a href="{{ $url }}" class="button button-{{ $color ?? 'primary' }}" target="_blank">{{ $slot }}</a>
        </td>
    </tr>
</table>