<table style="text-align:left;border:1px solid #c0c0c0;border-collapse:collapse;padding:5px">
    <tbody>
        <tr>
            <th style="vertical-align:middle;border:1px solid #c0c0c0;padding:5px">Informația despre solicitant</th>
            <td style="vertical-align:middle;border:1px solid #c0c0c0;padding:5px">
                <p>Numele Prenumele: {{$app['unifiedLoanApplication']['name']}} {{$app['unifiedLoanApplication']['surname']}}</p>
                <p>IDNO: {{$app['unifiedLoanApplication']['idno']}}</p>
                <p>Telefon: {{$app['unifiedLoanApplication']['phoneCell']}}</p>
            </td>
        </tr>
        <tr>
            <th style="vertical-align:middle;border:1px solid #c0c0c0;padding:5px">Condițiile împrumutului</th>
            <td style="vertical-align:middle;border:1px solid #c0c0c0;padding:5px">
                <p>Produsul: {{$app['unifiedLoanApplication']['loanProductName']}}</p>
                <p>Suma: {{$app['unifiedLoanApplication']['loanPurposeRows']['totalCost']}} MDL</p>
                <p>Termenul (luni): {{$app['unifiedLoanApplication']['creditTerm']}}</p>
                <p>Descrieţi scopul: {{$app['unifiedLoanApplication']['loanPurposeRows']['loanPurpose']}}</p>
            </td>
        </tr>
        <tr>
            <th style="vertical-align:middle;border:1px solid #c0c0c0;padding:5px">Informaţiia despre persoana de contact</th>
            <td style="vertical-align:middle;border:1px solid #c0c0c0;padding:5px">
                <p>Numele Prenumele: {{$app['unifiedLoanApplication']['contact']}}</p>
                <p>Telefon: {{$app['unifiedLoanApplication']['contactPhoneCell']}}</p>
                <p>Comment: {{$app['unifiedLoanApplication']['partnerComment']}}</p>
            </td>
        </tr>
        <tr>
            <th style="vertical-align:middle;border:1px solid #c0c0c0;padding:5px">Dealer</th>
            <td style="vertical-align:middle;border:1px solid #c0c0c0;padding:5px">
                <p>{{$app['user']}}</p>
            </td>
        </tr>
    </tbody>
</table>
<br>
- This e-mail was sent from (<a href="{{URL::to('/')}}">{{URL::to('/')}}</a>)