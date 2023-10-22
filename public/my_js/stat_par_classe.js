$(document).ready(function (){
    let btn = $('#recherche')
    console.log('bien')
    btn.on('click', function (){
        let classe = $("#classe")
        let option = $("#option")
        console.log(option.val())
        //console.log(classe.val())
        $.ajax({
            type:'post',
            url:'tri_par_classe',
            data:{'option': option.val(), 'classe':classe.val()},
            success:function(data){
                //console.log(data)

                let cpt = 1
                let tbody = '<table class="table align-items-center table-flush">\n' +
                    '    <thead>\n' +
                    '        <th>#</th>\n' +
                    '        <th>TOTAL</th>\n' +
                    '        <th>GENRE</th>\n' +
                    '        <th>EFFECTIF</th>\n' +
                    '    </thead><tbody id="tbody">'
                if(data.length  == 0)
                {
                    tbody += "<tr class='text-center text-danger'><td colspan='4'>pas d'info pour cette option </td></td>"
                    $("#tableau").html(tbody)
                }else{
                    for(let i = 0; i<data.length; i++)
                    {
                        cpt = cpt + i
                        tbody += "<tr>"
                        tbody+="<td>"+ cpt +"</td>"
                        tbody+="<td>"+ data[i]['description'] +"</td>"
                        tbody+="<td>"+ data[i]['totClass'] +"</td>"
                        // tbody+="<td>"+ data[i]['montant_reste'] +"</td>"
                        tbody+="</tr>"
                    }
                    tbody+='</tbody></table>'
                    console.log(data)
                    $("#tableau").html(tbody)
                }

            },
            error:function(e){
                console.error(e)
            }
        })
    })
})