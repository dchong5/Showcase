using KeyloMapping.Data.Entities;
//using MySql.Data.Entity;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace KeyloMappingSystem.DAL
{
    //[DbConfigurationType(typeof(MySqlEFConfiguration))]
    public class KeyloContext : DbContext
    {
        public KeyloContext()
          : base("name=KeyloDB")
        {
        }

        public DbSet<ddf> ddfs { get; set; }
    }
}
