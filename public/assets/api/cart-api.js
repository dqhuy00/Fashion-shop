const apiCart = {
    all({success , url, options}){
        $.ajax({
            url: '?controller=shop&' + url,
            method: 'GET',
            success: success,
            ...options
        })
    }
}