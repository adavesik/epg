$('.show-programs').click(function () {
    let date = $(this).data('date');
    let channelId = $('#channel_id').val()
    let url       = $('.programs-url').val()

    get(url, {channelId,date}).then( (response)=>{
        setUpResponse(response,{channelId,date})
    }).catch( (e)=>{
        console.log(e)
    })
})

function get(url,data) {
    return new Promise((resolve,reject)=>{
        $.ajax({
            method : 'GET',
            url,
            data,
            success:function (response) {
                resolve(response,data)
            },
            error:function (e) {
                reject(e)
            }
        })
    })

}

function setUpResponse(response,data) {

    $('.check-date').html(data.date)
    $('.part-1').html('')
    $('.part-2').html('')
    if (response.length==0){
        $('.part-1').html(`<li class="list-group-item"><div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab "></i>No Programs Found </div></li>`)
        return
    }

    let thumbClasses = [
        'fa-bitcoin',
        'fa-cloudsmith',
        'fa-asymmetrik',
        'fa-ethereum'
    ]
    let colorClasses = [
        'text-c-red',
        'text-c-blue',
        'text-c-yellow',
        'text-c-green',
    ];
    response.forEach(function (item,k) {
        let part = ''
        for (let i=0 ;i<item.length;i++){
            let thumbClass = randElement(thumbClasses)
            let colorClass = randElement(colorClasses)
            part+= `<li class="list-group-item">
                        <div class="float-right">${item[i].hi}</div>
                        <div class="d-flex align-items-center"> <i class="f-24 m-r-10 fab ${thumbClass} ${colorClass}"></i> ${item[i].title} </div>
                    </li>`
        }

        $('.part-'+(k+1)).html('')
        $('.part-'+(k+1)).html(part)
    })


}

function randElement(items) {
    return  items[Math.floor(Math.random() * items.length)];
}

function deleteFromDate(dataId,date){
    swal({
        title: "Are you sure?",
        text: ` Clicking OK will permanently DELETE all programs for the channel starting from this day  (  ${date}  ) till end of filled day.`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
           $('.delete-from-form[data-id='+dataId+']').submit();
        }
    });
}












