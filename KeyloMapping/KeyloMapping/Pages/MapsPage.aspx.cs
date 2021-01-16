using KeyloMapping.Data.POCOs;
using KeyloMappingSystem.BLL;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace KeyloMapping.Pages
{
    public partial class MapsPage : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            
        }

        #region Maps
        protected void Button_Fetch(object sender, EventArgs e)
        {
            MapsController sysmgr = new MapsController();

            string search = searchterm.Value;

            //List<LocationList> locations = new List<LocationList>();
            List<LocationList> locations = sysmgr.List_Search(search);
            LocationGV.DataSource = locations;
            LocationGV.DataBind();

            //List<LocationList> SearchList = locations;
            //Session["searchList"] = SearchList;

    }
        #endregion

        #region JSON
        public void ConvertToJsonALL()
        {
            MapsController sysmgr = new MapsController();
            List<LocationList> locations = sysmgr.Get_All();

            string result = JsonConvert.SerializeObject(locations);

            //string path = @"C:\Users\Dan\source\repos\KeyloMapping\ddf.json";
            //File.WriteAllText(path, result);

            /*
            List<LocationList> locationList = new List<LocationList>();
            foreach (LocationList item in locations)
            {
                locationList.ListingKey = item.ListingKey;
                locationList.Latitude = item.Latitude;
                locationList.Longitude = item.Longitude;
                locationList.City = item.City;
                locationList.UnparsedAddress = item.UnparsedAddress;
                locationList.UnitNumber = item.UnitNumber;
                locationList.PostalCode = item.PostalCode;
            }
            */
        }
        #endregion
    }
}