﻿using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace KeyloMapping.Data.Entities
{
    [Table("ddf")]
    public partial class ddf
    {
        [Key]
        public int ListingKey { get; set; }
        public string AnalyticsClick { get; set; }
        public string AnalyticsView { get; set; }
        public string ArchitecturalStyle { get; set; }
        public float AssociationFee { get; set; }
        public string AssociationFeeFrequency { get; set; }
        public string AttachedGarageYN { get; set; }
        public int BathroomsHalf { get; set; }
        public int BathroomsTotal { get; set; }
        public int BedroomsTotal { get; set; }
        public decimal BuildingAreaTotal { get; set; }
        public string BuildingAreaUnits { get; set; }
        public int CarportSpaces { get; set; }
        public string CarportYN { get; set; }
        public string City { get; set; }
        public string CoListAgentCellPhone { get; set; }
        public string CoListAgentDesignation { get; set; }
        public string CoListAgentDirectPhone { get; set; }
        public string CoListAgentEmail { get; set; }
        public string CoListAgentFax { get; set; }
        public string CoListAgentFullName { get; set; }
        public int CoListAgentKey { get; set; }
        public string CoListAgentOfficePhone { get; set; }
        public string CoListAgentOfficePhoneExt { get; set; }
        public string CoListAgentPager { get; set; }
        public string CoListAgentTollFreePhone { get; set; }
        public string CoListAgentURL { get; set; }
        public string CoListOfficeFax { get; set; }
        public int CoListOfficeKey { get; set; }
        public string CoListOfficeName { get; set; }
        public string CoListOfficePhone { get; set; }
        public string CoListOfficePhoneExt { get; set; }
        public string CoListOfficeURL { get; set; }
        public string CommunityFeatures { get; set; }
        public string ConstructionMaterials { get; set; }
        public string Cooling { get; set; }
        public string CoolingYN { get; set; }
        public string Country { get; set; }
        public int CoveredSpaces { get; set; }
        public string Fencing { get; set; }
        public string FireplaceFeatures { get; set; }
        public string FireplaceFuel { get; set; }
        public int FireplacesTotal { get; set; }
        public string Flooring { get; set; }
        public string FrontageLength { get; set; }
        public string FrontageType { get; set; }
        public int GarageSpaces { get; set; }
        public bool GarageYN { get; set; }
        public string GreenBuildingCertification { get; set; }
        public string GreenCertificationRating { get; set; }
        public string Heating { get; set; }
        public string HeatingFuel { get; set; }
        public string Latitude { get; set; }
        public decimal Lease { get; set; }
        public string LeaseFrequency { get; set; }
        public string LeaseTerm { get; set; }
        public decimal Levels { get; set; }
        public string ListAgentCellPhone { get; set; }
        public string ListAgentDesignation { get; set; }
        public string ListAgentDirectPhone { get; set; }
        public string ListAgentEmail { get; set; }
        public string ListAgentFax { get; set; }
        public string ListAgentFullName { get; set; }
        public int ListAgentKey { get; set; }
        public string ListAgentOfficePhone { get; set; }
        public string ListAgentOfficePhoneExt { get; set; }
        public string ListAgentPager { get; set; }
        public string ListAgentURL { get; set; }
        public string ListAOR { get; set; }
        public string ListingContractDate { get; set; }
        public string ListingId { get; set; }
        public string ListOfficeFax { get; set; }
        public int ListOfficeKey { get; set; }
        public string ListOfficeName { get; set; }
        public string ListOfficePhone { get; set; }
        public string ListOfficePhoneExt { get; set; }
        public string ListOfficeURL { get; set; }
        public decimal ListPrice { get; set; }
        public string Longitude { get; set; }
        public string LotFeatures { get; set; }
        public decimal LotSizeArea { get; set; }
        public string LotSizeUnits { get; set; }
        public string ModificationTimestamp { get; set; }
        public string MoreInformationLink { get; set; }
        public int NumberOfUnitsTotal { get; set; }
        public int OpenParkingSpaces { get; set; }
        public string OpenParkingYN { get; set; }
        public string OriginatingSystemKey { get; set; }
        public string OriginatingSystemName { get; set; }
        public string OwnershipType { get; set; }
        public int ParkingTotal { get; set; }
        public string PhotosChangeTimestamp { get; set; }
        public int PhotosCount { get; set; }
        public string PoolFeatures { get; set; }
        public string PoolYN { get; set; }
        public string PostalCode { get; set; }
        public string PropertyType { get; set; }
        public string PublicRemarks { get; set; }
        public string Roof { get; set; }
        public string RoomDimensions1 { get; set; }
        public string RoomDimensions10 { get; set; }
        public string RoomDimensions11 { get; set; }
        public string RoomDimensions12 { get; set; }
        public string RoomDimensions13 { get; set; }
        public string RoomDimensions14 { get; set; }
        public string RoomDimensions15 { get; set; }
        public string RoomDimensions16 { get; set; }
        public string RoomDimensions17 { get; set; }
        public string RoomDimensions18 { get; set; }
        public string RoomDimensions19 { get; set; }
        public string RoomDimensions2 { get; set; }
        public string RoomDimensions20 { get; set; }
        public string RoomDimensions3 { get; set; }
        public string RoomDimensions4 { get; set; }
        public string RoomDimensions5 { get; set; }
        public string RoomDimensions6 { get; set; }
        public string RoomDimensions7 { get; set; }
        public string RoomDimensions8 { get; set; }
        public string RoomDimensions9 { get; set; }
        public string RoomLengthWidthUnits1 { get; set; }
        public string RoomLengthWidthUnits10 { get; set; }
        public string RoomLengthWidthUnits11 { get; set; }
        public string RoomLengthWidthUnits12 { get; set; }
        public string RoomLengthWidthUnits13 { get; set; }
        public string RoomLengthWidthUnits14 { get; set; }
        public string RoomLengthWidthUnits15 { get; set; }
        public string RoomLengthWidthUnits16 { get; set; }
        public string RoomLengthWidthUnits17 { get; set; }
        public string RoomLengthWidthUnits18 { get; set; }
        public string RoomLengthWidthUnits19 { get; set; }
        public string RoomLengthWidthUnits2 { get; set; }
        public string RoomLengthWidthUnits20 { get; set; }
        public string RoomLengthWidthUnits3 { get; set; }
        public string RoomLengthWidthUnits4 { get; set; }
        public string RoomLengthWidthUnits5 { get; set; }
        public string RoomLengthWidthUnits6 { get; set; }
        public string RoomLengthWidthUnits7 { get; set; }
        public string RoomLengthWidthUnits8 { get; set; }
        public string RoomLengthWidthUnits9 { get; set; }
        public string RoomLevel1 { get; set; }
        public string RoomLevel10 { get; set; }
        public string RoomLevel11 { get; set; }
        public string RoomLevel12 { get; set; }
        public string RoomLevel13 { get; set; }
        public string RoomLevel14 { get; set; }
        public string RoomLevel15 { get; set; }
        public string RoomLevel16 { get; set; }
        public string RoomLevel17 { get; set; }
        public string RoomLevel18 { get; set; }
        public string RoomLevel19 { get; set; }
        public string RoomLevel2 { get; set; }
        public string RoomLevel20 { get; set; }
        public string RoomLevel3 { get; set; }
        public string RoomLevel4 { get; set; }
        public string RoomLevel5 { get; set; }
        public string RoomLevel6 { get; set; }
        public string RoomLevel7 { get; set; }
        public string RoomLevel8 { get; set; }
        public string RoomLevel9 { get; set; }
        public string RoomWidth1 { get; set; }
        public string RoomWidth10 { get; set; }
        public string RoomWidth11 { get; set; }
        public string RoomWidth12 { get; set; }
        public string RoomWidth13 { get; set; }
        public string RoomWidth14 { get; set; }
        public string RoomWidth15 { get; set; }
        public string RoomWidth16 { get; set; }
        public string RoomWidth17 { get; set; }
        public string RoomWidth18 { get; set; }
        public string RoomWidth19 { get; set; }
        public string RoomWidth2 { get; set; }
        public string RoomWidth20 { get; set; }
        public string RoomWidth3 { get; set; }
        public string RoomWidth4 { get; set; }
        public string RoomWidth5 { get; set; }
        public string RoomWidth6 { get; set; }
        public string RoomWidth7 { get; set; }
        public string RoomWidth8 { get; set; }
        public string RoomWidth9 { get; set; }
        public string Sewer { get; set; }
        public string StateOrProvince { get; set; }
        public decimal Stories { get; set; }
        public string StreetAdditionalInfo { get; set; }
        public string StreetDirPrefix { get; set; }
        public string StreetDirSuffix { get; set; }
        public string StreetName { get; set; }
        public string StreetNumber { get; set; }
        public string StreetSuffix { get; set; }
        public string SubdivisionName { get; set; }
        public string UnitNumber { get; set; }
        public string UnparsedAddress { get; set; }
        public string View { get; set; }
        public string ViewYN { get; set; }
        public string WaterBodyName { get; set; }
        public string WaterfrontYN { get; set; }
        public int YearBuilt { get; set; }
        public string Zoning { get; set; }
    }
}

