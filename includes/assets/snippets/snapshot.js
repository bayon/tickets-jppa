 function snapShot( ){
            console.log('snapshot:');
            var snapData ={};
            snapData.id = 'null';
            snapData.name = 'snapshot_timestamp';
            var description_json =   JSON.stringify(TABLE_DATA);
            snapData.description = description_json;
            snapData.created_dt = 'timestamp';
            //var dataString = "c=todo_controller&m=create&data_only=true&data="+data;
            var params = $.param(snapData);
            console.log(params);
            var dataString = 'c=snapshot_controller&m=snapshot&data_only=true&' + params;
            ajax_datastring_URL_callback(dataString, JS_CONFIG.BASE_URL, snapShot_callback);
        }