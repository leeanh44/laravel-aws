const sendRequest = (url, method, data = {}, cb) => {  
    return $.ajax({
        url: url,
        timeout: 100000,
        type: method,
        data: data,
        beforeSend: function(request) {
            return request.setRequestHeader(
                "X-CSRF-Token",
                $("meta[name='csrf-token']").attr("content")
            );
        },
        dataType: "json",
        success: function(response) {
            cb(response);
        },
        error: function(response) {
            cb(response);
        }
    });
}

const sendRequestFormData = (url, method, data = {}, cb) => {  
    return $.ajax({
        url: url,
        timeout: 100000,
        type: method,
        data: data,
        contentType: false,
        processData: false,
        beforeSend: function(request) {
            return request.setRequestHeader(
                "X-CSRF-Token",
                $("meta[name='csrf-token']").attr("content")
            );
        },
        success: function(response) {
            cb(response);
        }
    });
}

export {
    sendRequest,
    sendRequestFormData
}

const requester = {
    send: sendRequest,
    sendFormData: sendRequestFormData
};
  
export default requester;
  