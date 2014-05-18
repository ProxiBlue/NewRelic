Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

function fetchApplicationNames() {
    new Ajax.Request(newrelic_base_url + 'newrelic/api/names/key/'+$('newrelic_api_api_key').value, {
        onSuccess: function(response) {
            var json = response.responseText.evalJSON();
            if(json.error) {
                alert(json.error);
                exit;
            }
            var appnames = json.result, index;
            selbox = $('newrelic_api_application_name');
            var options = selbox.options;
            $$('select#newrelic_api_application_name option').each(function(el) {
                if (appnames.indexOf(el.value) != -1 ) {
                    //console.log(el.value);
                    appnames.remove(el.value);
                }
            });
            // Loop the states 
            for (index = 0; index < appnames.length; ++index) {
                //console.log(appnames[index]);
                options[selbox.options.length] = new Option(
                        appnames[index],
                        appnames[index]
                        );
            }
        }
    });
}

function fetchAccountDetails() {
    new Ajax.Request(newrelic_base_url + 'newrelic/api/accountDetails/key/'+$('newrelic_api_api_key').value, {
        onSuccess: function(response) {
            var json = response.responseText.evalJSON();
            if(json.error) {
                alert(json.error);
                exit;
            }
            $('newrelic_api_account_id').value = json.accountid;
            $('newrelic_api_data_access_key').value = json.accesskey;
            $('newrelic_api_license_key').value = json.licensekey;
        }
    });
}


