<%@ Page Title="" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="MapsPage.aspx.cs" Inherits="KeyloMapping.Pages.MapsPage" %>
<asp:Content ID="Content1" ContentPlaceHolderID="MainContent" runat="server">
  
    <style type="text/css">
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        #map {
            height: 50rem;
            width: 117rem;
        }

        /*Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        form{
            width: 100%;
        }

        form input:first-child{
            width: 110rem;
        }

        .search{
            display: flex;
        }
    </style>

    <div class="row">

        <div class="jumbotron"><h1>Keylo Project</h1></div>
        <br />

        <div class="search">
            <Input type="text" ID="searchterm" name="searchterm" class="form-control" runat="server" ClientIDMode="Static" value=""/>
            <asp:Button ID="Fetch" runat="server" Text="GO" OnClick="Button_Fetch" CssClass="btn btn-sm btn-outline-primary" ClientIDMode="Static"/>
        </div>
        <br />

        <div id="map"></div>
        

        <%-- TESTING DATA IN GRIDVIEW --%>
        <h2>Test DBdata</h2>
        <asp:GridView ID="LocationGV" runat="server" AutoGenerateColumns="false" CssClass="table table-sm table-striped table-bordered table-hover">
                <Columns>                 
                    <asp:TemplateField HeaderText="ID" Visible="true" HeaderStyle-Width="75px">
                        <ItemTemplate>
                            <asp:Label ID="ListingKey" runat="server" 
                                Text='<%# Eval("ListingKey") %>'></asp:Label>
                        </ItemTemplate>
                    </asp:TemplateField>

                    <asp:TemplateField HeaderText="Lat" Visible="true" HeaderStyle-Width="85px">
                        <ItemTemplate>
                            <asp:Label ID="Latitude" runat="server" 
                                Text='<%# Eval("Latitude") %>'></asp:Label>
                        </ItemTemplate>
                    </asp:TemplateField>
                    <asp:TemplateField HeaderText="Long" HeaderStyle-Width="85px" ItemStyle-CssClass="align-middle">
                        <ItemTemplate>
                            <asp:Label ID="Longitude" runat="server" 
                                Text='<%# Eval("Longitude") %>'></asp:Label>
                        </ItemTemplate>
                    </asp:TemplateField>
                    <asp:TemplateField HeaderText="City" HeaderStyle-Width="75px" ItemStyle-CssClass="text-center align-middle">
                        <ItemTemplate>
                            <asp:Label ID="City" runat="server" 
                                Text='<%# Eval("City") %>'></asp:Label>
                        </ItemTemplate>
                    </asp:TemplateField>
                    <asp:TemplateField HeaderText="UnparsedAddress" HeaderStyle-Width="150px" ItemStyle-CssClass="text-center align-middle">
                        <ItemTemplate>
                            <asp:Label ID="UnparsedAddress" runat="server" 
                                Text='<%# Eval("UnparsedAddress") %>'></asp:Label>
                        </ItemTemplate>
                    </asp:TemplateField>
                    <asp:TemplateField HeaderText="Unit Number" HeaderStyle-Width="65px" ItemStyle-CssClass="text-right align-middle">
                        <ItemTemplate>
                            <asp:Label ID="UnitNumber" runat="server" 
                                Text='<%# Eval("UnitNumber") %>'></asp:Label>
                        </ItemTemplate>
                    </asp:TemplateField>
                    <asp:TemplateField HeaderText="Postal Code" HeaderStyle-Width="65px" ItemStyle-CssClass="text-right align-middle">
                        <ItemTemplate>
                            <asp:Label ID="PostalCode" runat="server" 
                                Text='<%# Eval("PostalCode") %>'></asp:Label>
                        </ItemTemplate>
                    </asp:TemplateField>                
                </Columns>
                <EmptyDataTemplate>
                    Nothing To Show Here
                </EmptyDataTemplate>
            </asp:GridView>

        <script>

            let map;

            let markers = [];
            let locationList = [];
            let cityList = [];
            let unknownLat = 0;
            let unknownLong = 0;

            const locations = fetch("../Json/ddf.json")
                .then((response) => response.json())
                .then((data) => { data.forEach((i) => locationList.push(i)) });

            const cities = fetch("../Json/CanadianCities.json")
                .then((response) => response.json())
                .then((data) => { data.forEach((i) => cityList.push(i)) });

            const searchButton = document.getElementById('Fetch');
            var searchterm = document.getElementById('searchterm');


            function initMap() {

                const putmarkerEdmonton = { lat: 53.5461, lng: -113.4938 };
                const putmarkerCalgary = { lat: 51.0447, lng: -114.0719 };

                //Initial Starting Point on load
                map = new google.maps.Map(document.getElementById("map"), {
                    center: putmarkerEdmonton,
                    zoom: 8,
                });
            }

            //EVENT LISTENER ON MARKER
            searchButton.addEventListener('click', function (e) {
                e.preventDefault();
                clearMarkers();
                deleteMarkers();
                let searchtermval = searchterm.value;
                let searchedLat = 0;
                let searchedLong = 0;
                
                //Async google api lookup address
                var temp = getFromYourAPI(searchtermval)

                //Resolve Async
                temp.then(response => {

                    searchedLat = response.lat
                    searchedLong = response.lng

                    //Create the min and max values for the Long and Lat Range
                    let minsearchedLong = searchedLong - 0.01;
                    let maxsearchedLong = searchedLong + 0.01;
                    let minsearchedLat = searchedLat - 0.01;
                    let maxsearchedLat = searchedLat + 0.01;

                    //For locations without a lat lng we will run through the location finder and get lat lng
                    for (var i = 0; i < locationList.length; i++) {
                        var item = locationList[i];
                        var title = String(item.ListingKey);
                        var newlatlng = [];

                        if ((item.Latitude == 0) || (item.Latitude == null)) {
                            newlatlng = getLatLong(item.UnparsedAddress);

                            //Then we run it like we have lat lng
                            if ((newlatlng[lng] > minsearchedLong) && (newlatlng[lng] < maxsearchedLong)) {

                                if ((newlatlng[lat] > minsearchedLat) && (newlatlng[lat] < maxsearchedLat)) {

                                    var lat = parseFloat(newlatlng[lat]);
                                    var long = parseFloat(newlatlng[lng]);
                                    var putmarker = { lat: lat, lng: long };

                                    var searchmarker = new google.maps.Marker({
                                        position: putmarker,
                                        map: map,
                                        title: title,
                                    });

                                    markers.push(searchmarker);
                                }
                            }
                        }
                        else {
                            //Else just continue on as normal
                            if ((item.Longitude > minsearchedLong) && (item.Longitude < maxsearchedLong)) {

                                if ((item.Latitude > minsearchedLat) && (item.Latitude < maxsearchedLat)) {

                                    var lat = parseFloat(item.Latitude);
                                    var long = parseFloat(item.Longitude);
                                    var putmarker = { lat: lat, lng: long };

                                    var searchmarker = new google.maps.Marker({
                                        position: putmarker,
                                        map: map,
                                        title: title,
                                    });

                                    markers.push(searchmarker);
                                }
                            }
                        }
                    }

                    //Set Markers
                    setMapOnAll(map);

                })
            })

            // Sets the map on all markers in the array.
            function setMapOnAll(map) {
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }

            //CLEAR MARKER BUT KEEP ARRAY
            function clearMarkers() {
                setMapOnAll(null);
            }

            //SHOW MARKERS
            function showMarkers() {
                setMapOnAll(map);
            }

            //DELETE MARKERS CLEAR ARRAY
            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }

            //BY ADDRESS AND CENTER MAP
            function geocodeAddress(the_address) {

                var result = [];
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address': the_address }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);

                        var result0 = (results[0].geometry.location.lat());
                        var result1 = (results[0].geometry.location.lng());

                        result.push(result0);
                        result.push(result1);
                    }

                    else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }

                    //console.log(result);

                })
                //console.log(result);
                return result;
            }
            
            //the call to your API geoCoder thing
            function getFromYourAPI(address) {
                let coordinate = {}

                var geocoder = new google.maps.Geocoder();
                let returnData = new Promise((resolve, reject) => {
                    geocoder.geocode({ 'address': address }, function (results, status) {

                        if (status == 'OK') {
                            //center map on searched location
                            map.setCenter(results[0].geometry.location);

                            coordinate.lat = results[0].geometry.location.lat()
                            coordinate.lng = results[0].geometry.location.lng()
                            resolve(coordinate)
                        } else {
                            reject(status)
                        }

                    })
                });

                return returnData
            }



        </script>
        <%--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>--%>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

        <script defer
            src="https://maps.googleapis.com/maps/api/js?key=MYAPIKEY&callback=initMap">
        </script>
    </div>
</asp:Content>
