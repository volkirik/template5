<script language="javascript" type="text/javascript">
    function selectDomains(theElement) {
        var theForm = theElement.form, z = 0;
        while (theForm[z].type == 'checkbox' && theForm[z].name != 'checkall') {
            theForm[z].checked = theElement.checked;
            z++;
        }
    }

    function acceptAgreement() {
        if (document.domainRenew.agreement.checked) {
            document.domainRenew.submit1.disabled = false;
            document.domainRenew.submit2.disabled = false;	
        } else {
            document.domainRenew.submit1.disabled = true;
            document.domainRenew.submit2.disabled = true;
        }
    }
</script>

<br>
<form method="post" action="{$php_self}">
<table width="98%" class="border1" style="padding: 1px" cellspacing="1" cellpadding="2" align="center">
    <caption><b>Alan Adı Otomatik Yenileme Durumu Sorgusu</b></caption>
    <tr>
        <td class=cellBg align="center">
            Alan Adı Uzantısı:
            <select name="gtld">
                <option value=""></option>
                {section name=r loop=$tld}
                    <option value={$tld[r][0]}>{$tld[r][1]}</option>
                {/section}
            </select>&nbsp; &nbsp;
            <span style="display:{$show_query}">Kullanıcı: <input type="text" name="member_name">&nbsp; &nbsp; &nbsp;</span>
        </td>
    </tr>
    <tr>
        <td class=cellBg align="center">
            Alan Adı Otomatik Yenileme: &nbsp; &nbsp; &nbsp;
            <input type="radio" name=renew_status value="enabled">Evet &nbsp; 
            <input type="radio" name=renew_status value="disabled">Hayır &nbsp; 
        </td>
    </tr>
    <tr>
        <td class=cellBg align="center">
            Alan Adı: <input type="text" name="domain">&nbsp; &nbsp;
            <input type="submit" name="Submit" value="Ara">
            <input type="hidden" name="action" value="listDomains">
        </td>
    </tr>
    <tr>
        <td class=cellBg2>
            <font color="#FF0000">Arama:</font> Alan adı uzantısını, alan adı otomatik yenileme durumunu seçebilir veya 
            belirli alan adlarını arayabilir, otomatik yenileme seçeneğini etkinleştirmek veya devre dışı bırakmak için
            alan adı girebilirsiniz.
        </td>
    </tr>
</table>
</form>

<form method="post" action="{$php_self}" name="domainRenew">
    <table width="98%" class="border1" style="padding: 0px" cellspacing="1" cellpadding="2" align="center">
        <tr class="fieldName">
            <td><input type="checkbox" name="selectdomain" onClick="selectDomains(this)"></td>
            <td align="center"><b><font color="#FFFFFF">Alan Adı</font></b></td>
            <td align="center"><b><font color="#FFFFFF">Alan Adı Otomatik Yenileme Durumu</font></b></td>
            <td align="center"><b><font color="#FFFFFF">Alan Adı Son Kullanma Tarihi</font></b></td>        
        </tr>
        {section name=i loop=$rs}
            <tr>
                <td class="p8" {$rs[i][1]}>
                    <input type="checkbox" name="renew_domains[]" value="{$rs[i][0][0]}">
                </td>
                <td class="p8" {$rs[i][1]} align="center"> {$rs[i][0][0]} </td>
                <td class="p8" {$rs[i][1]} align="center"> {$rs[i][0][1]} </td>
                <td class="p8" {$rs[i][1]} align="center"> {$rs[i][0][2]} </td>
            </tr>
        {/section}
        <tr bgcolor="#CCCCCC">
            <td colspan="4"> {$pagebutton} </td>
        </tr>
    </table>
    <table width="98%" align="center">
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td align="center">
                <input type="checkbox" name="agreement" onClick="acceptAgreement()">
                <label> <input type="hidden" name="action" value="renewDomains">
                <a href="{$RELA_DIR}help/domain_auto_renewal_agreement.html" target="blank">Alan Adı Otomatik Yenileme Anlaşması</a>ni okudum, anladım ve kabul ediyorum
            </label>
            </td>
        </tr>
        <tr><td><hr></td></tr>
        <tr>
            <td align="center" colspan="4">
                <input type="submit" name="submit1" value="Otomatik Yenilemeyi Etkinleştir" disabled="true"> &nbsp; &nbsp;
                <input type="submit" name="submit2" value="Otomatik Yenilemeyi Devre Dışı Bırak" disabled="true">
            </td>
        </tr>
    </table>
    <input type="hidden" name="transation" value="{$transation}">
</form>

<table width="95%" class=border1 align="center">
    <tr><td></td></tr>
    <tr>
        <td>
            &nbsp; &nbsp; Eğer alan adı abc.com'un son kullanma tarihi 10/10/2004 ise, alan adı yenileme için 10 gün süren bir
            süre verilecektir.<br>
            &nbsp; &nbsp; Yenileme işlemi 10/1/2004'te başlayacak ve 10/10/2004'te sona erecektir. Bu süre zarfında, 
            hesabınızı finanse etmek için yeterli zamanınız olacak.<br><br>
            &nbsp; &nbsp; Not: Alan adının otomatik olarak yenilenmesini istemiyorsanız, lütfen alan adı son kullanma tarihinden
            günler önce otomatik yenilemeyi devre dışı bırakın.
        </td>
    </tr>
</table>

