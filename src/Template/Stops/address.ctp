<!-- src/Template/Users/address.ctp -->
<?php $this->start('scriptBlock'); ?>
    <script>

        function loadDoc(loc) {

            document.getElementById("xmlStat").innerHTML   = "XML progress: ";
            document.getElementById("httpStat").innerHTML  = "http status : ";
            document.getElementById("urlString").innerHTML = "url String : ";
            document.getElementById("msgStat").innerHTML   = "msg status : ";
            document.getElementById("err").innerHTML       = "Err : ";

            var stNo,stName,Suburb;

            if (loc == 1){
                document.getElementById("depAddress").innerHTML   = "address : ";
                document.getElementById("depLatLons").innerHTML   = "lat Lons : ";
                document.getElementById("depLatLons").innerHTML = "Finding lat lons...."
                stNo = document.getElementById("DepStNo").value;
                stName = document.getElementById("DepStName").value;
                Suburb = document.getElementById("DepSuburb").value;
            }else 
            if (loc ==2){
                
                document.getElementById("arrAddress").innerHTML   = "Address : ";
                document.getElementById("arrLatLons").innerHTML   = "lat Lons : ";
                document.getElementById("arrLatLons").innerHTML = "Finding lat lons...."
                stNo = document.getElementById("ArrStNo").value;
                stName = document.getElementById("ArrStName").value;
                Suburb = document.getElementById("ArrSuburb").value;
            }
            else{
                document.getElementById("err").innerHTML = "error on loadDoc()";
                return;
            } 

            // create the response listener
            // this->readyState	Holds the status of the XMLHttpRequest. 
            //   0: request not initialized 
            //    1: server connection established
            //    2: request received 
            //    3: processing request 
            //    4: request finished and response is ready
            // create the request object

            var xhttp = new XMLHttpRequest();
            xhttp.addEventListener("load", loadListener);
            xhttp.addEventListener("error", errListener);
            var count1 = 0;
            var count2 = 0;

            function errListener() { // this called if error error
                document.getElementById("xmlStat").innerHTML += this.readyState;
                document.getElementById("httpStat").innerHTML += this.statusText;
            }

            function loadListener() { // this called when the server responds
                // to reach here we need status 4
                document.getElementById("responseURL").innerHTML= this.responseURL;
                count1++;
                document.getElementById("xmlStat").innerHTML += this.readyState;
                document.getElementById("httpStat").innerHTML += this.statusText;

                if (this.status == 200) { // server responeded
                    count2++;
                    var locObj =  JSON.parse(this.responseText);
                    //alert(this.responseText);

                    // now check what was returned exactly
                    var addr ="";
                    var matches;
                    if (locObj.status == "OK") { // the we have some kind of match
                        // count number of matches
                        matches = locObj.results.length;
                        for (i=0; i<matches; i++){
                            //addr+="<p>"+locObj.results[i].geometry+"</p>"
                            addr+=locObj.results[i].formatted_address+"<br>";
                        }
                        document.getElementById("msgStat").innerHTML += locObj.status;
                        if (loc==1){
                            //document.getElementById("depLatLons").innerHTML = "lat= "+locObj.results[0].geometry.location.lat+" lon= "+locObj.results[0].geometry.location.lng;
                            document.getElementById("depAddress").innerHTML = addr;
                            if (matches ==1){
                                document.getElementById("depLatLons").innerHTML = "("+locObj.results[0].geometry.location.lat+" , "+locObj.results[0].geometry.location.lng+")";
                            }
                        } else{ // loc == 2
                            //document.getElementById("arrLatLons").innerHTML = "lat= "+locObj.results[0].geometry.location.lat+" lon= "+locObj.results[0].geometry.location.lng;
                            if (matches ==1){
                                document.getElementById("arrAddress").innerHTML = addr;
                            }
                            document.getElementById("arrLatLons").innerHTML = "("+locObj.results[0].geometry.location.lat+" , "+locObj.results[0].geometry.location.lng+")";
                        }
                    } // end status = 200
                } // end loadListener
            }; // end loadDoc
    
            var params = encodeURI(stNo+" "+stName+" "+Suburb+"&sensor=false");
            var req = "http://maps.googleapis.com/maps/api/geocode/json?address="+params;
            document.getElementById("urlString").innerHTML += req;
            xhttp.open("GET", req, true);
            xhttp.send();
        }
    </script>
<?php $this->end(); ?>

<div class = 'row'>
    <div class="col-sm-6">
        <div class="form-group">
            <?=$this->Form->create() ?>
                <fieldset>
                    <legend><?=__('Enter Departure address') ?></legend>
                    <?=$this->Form->control('DepStNo',['id' => 'DepStNo','class'=>'form-control']) ?>
                    <?=$this->Form->control('DepStName',['id' => 'DepStName','class'=>'form-control']) ?>
                    <?=$this->Form->control('DepSuburb',   ['id' => 'DepSuburb','class'=>'form-control']) ?>
                </fieldset>
            <?=$this->Form->end() ?>
            <br>
            <button type="button" onclick="loadDoc(1)">Get LatLon</button>
            <div id="depAddress"></div>
            <div id="depLatLons"></div> 
        </div>
    </div>    
    <div class="col-sm-6">
        <div class="form-group">
            <?=$this->Form->create() ?>
                <fieldset>
                    <legend><?=__('Enter Arrival address') ?></legend>
                    <?=$this->Form->control('ArrStNo',['id' => 'ArrStNo','class'=>'form-control']) ?>
                    <?=$this->Form->control('ArrStName',['id' => 'ArrStName','class'=>'form-control']) ?>
                    <?=$this->Form->control('ArrSuburb',   ['id' => 'ArrSuburb','class'=>'form-control']) ?>
                </fieldset>
            <?=$this->Form->end() ?>
            <br>
            <button type="button" onclick="loadDoc(2)">Get LatLon</button>
            <div id="arrAddress"></div>
            <div id="arrLatLons"></div>
        </div>     
    </div> 
</div> 
<div class = 'row'>
    <div class="col-sm-12">
        <div id="urlString"></div> 
        <div id="xmlStat"></div>
        <div id="httpStat"></div>
        <div id="msgStat"></div>
        <div id="responseURL"></div>
        <div id="err"></div> 
    </div>
</div>