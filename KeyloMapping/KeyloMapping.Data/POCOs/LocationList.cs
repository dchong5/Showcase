using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace KeyloMapping.Data.POCOs
{
    public class LocationList
    {
        public int ListingKey { get; set; }
        public string Latitude { get; set; }
        public string Longitude { get; set; }
        public string City { get; set; }
        public string UnparsedAddress { get; set; }
        public string UnitNumber { get; set; }
        public string PostalCode { get; set; }
    }
}
