using KeyloMapping.Data.POCOs;
using KeyloMappingSystem.DAL;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace KeyloMappingSystem.BLL
{
    [DataObject]
    public class MapsController
    {
        //*****Assumption that if variable has a lat value, there will be a long value input as well*****

        //GET EVERYTHING (but items only that have long and lat)
        [DataObjectMethod(DataObjectMethodType.Select, false)]
        public List<LocationList> Get_All()
        {
            //Get Everything
            using (var context = new KeyloContext())
            {
                var data = context.ddfs
                    .Where(x => x.Latitude != "")
                    .Select(x => new LocationList
                    {
                        ListingKey = x.ListingKey,
                        Latitude = x.Latitude,
                        Longitude = x.Longitude,
                        City = x.City,
                        UnparsedAddress = x.UnparsedAddress,
                        UnitNumber = x.UnitNumber,
                        PostalCode = x.PostalCode
                    })
                    .ToList();

                return data;
            }
        }

        //LIST OF PLACES
        [DataObjectMethod(DataObjectMethodType.Select, false)]
        public List<LocationList> List_Search(string searchlocation)
        {
            //search and see if city is Edmonton and the Lat is not empty
            using (var context = new KeyloContext())
            {
                var data = context.ddfs
                    .Where(x => (x.City == searchlocation) && (x.Latitude != ""))
                    .Select(x => new LocationList
                    {
                        ListingKey = x.ListingKey,
                        Latitude = x.Latitude,
                        Longitude = x.Longitude,
                        City = x.City,
                        UnparsedAddress = x.UnparsedAddress,
                        UnitNumber = x.UnitNumber,
                        PostalCode = x.PostalCode
                    })
                    .ToList();

                return data;
            }
        }

        //Will use this to search for one item at a time
        [DataObjectMethod(DataObjectMethodType.Select, false)]
        public LocationList Place_Search()
        {
            using (var context = new KeyloContext())
            {
                var data = context.ddfs
                    .Where(x => x.City == "Edmonton")
                    .Select(x => new LocationList
                    {
                        ListingKey = x.ListingKey,
                        Latitude = x.Latitude,
                        Longitude = x.Longitude,
                        City = x.City,
                        UnparsedAddress = x.UnparsedAddress,
                        UnitNumber = x.UnitNumber,
                        PostalCode = x.PostalCode
                    })
                    .FirstOrDefault();

                return data;
            }
        }
    }
}
