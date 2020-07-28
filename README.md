# Orange County, California Buildings and Addresses

## Background

When mapping my local city I have found that large swaths were inaccessible to me. Some were private gated subdivisions. Others were not within walking distance of public parking.

My initial goal was to fill in the blanks in my city that I was unable to do on foot. But once I found that data for the entire county I live in was available with an OSM compatible license I decided to increase the scope.

The current goal is to fully map all buildings and addresses within my local county.

Note: [ERSI is processing this same data to make it available via MapWithAI](https://wiki.openstreetmap.org/wiki/Import/Orange_County,_California_Buildings). I believe with good working practices there should be no conflict between the two efforts. Some areas I will get to first while other areas mappers using the new MapWithAI data will get to first.

### Team

This will be a solo import.

### Import Type

One time import.

### Import Method

JOSM will be used for importing.

### Relevant Webpages

- [Official Orange County Government Main Page](https://www.ocgov.com/)
- [Orange County GIS Access Page](https://www.ocpublicworks.com/gov/pw/survey/services/gis.asp)
- [Orange County GIS Data](https://data-ocpw.opendata.arcgis.com/)
- [Building and Address Dataset](https://data-ocpw.opendata.arcgis.com/datasets/8db4b58e6bbf4f6cac676f477348be48_0)
- [GitHub project for this import](https://github.com/n76/OSM_OC_Buildings)
- [OSM Wiki page for this import](https://wiki.openstreetmap.org/wiki/Orange_County_Building_and_Address_Import)
- [OSM Wiki page for the ERSI effort to make this data available via MapWithAI.](https://wiki.openstreetmap.org/wiki/Import/Orange_County,_California_Buildings)

### GitHub and OSM Wiki

This document exists on both [GitHub](https://github.com/n76/OSM_OC_Buildings) and the OSM Wiki. The intent is to keep them both in sync.

## The Data

### Location of Dataset

The [Building foot print data page](https://data-ocpw.opendata.arcgis.com/datasets/8db4b58e6bbf4f6cac676f477348be48_0) is accessible indirectly from the Orange County Public Works Department page.

### License

The license on the dataset is listed as [Public Domain](https://creativecommons.org/publicdomain/zero/1.0/).

### Content

The description provided by the county says:
>This polygon feature class depicts buildings throughout Orange County. The object heights and absolute heights are based on 2011 USGS LiDAR data. The height unit is US foot.
>
>The values of Address column in "Data" tag are empty for those buildings outside of Orange County.

Attributes listed are:

- ABS_HT - The elevation in feet.
- ADDRESS - Contains house number and capitalized abbreviated street name.
- CITY  - Contains capitalized city name.
- HEIGHT - Building height in feet.
- ZIPCODE - 5 digit ZIP code.
- OBJECTID - A unique (at least to this dataset) number.

Downloaded ZIP file contains a shapefile and its associated companion files. The dataset downloaded on July 25, 2020 contains:

- 754,813 Building outlines
- 718,125 Buildings with addresses.
- 716,941 Buildings with height information.

### Quality Issues

The quality of this data is too low to attempt any type of automatic or totally scripted import. Each building needs to be examined for flaws  individually prior to inclusion into OSM. Specific issues noted while comparing the Orange County data with existing OSM data or aerial imagery are described below.

#### Building Outlines

Overlaying the building outlines in this dataset with the Microsoft/Bing outlines available in the MapWithAI layer available in JOSM leads me to believe that they are identical. These outlines will need significant manual work when importing to correct them using the best available OSM compatible imagery. Quality issues noted in areas examined include:
- Misalignment of buildings.
- Lack of detail: Simple rectangle where building has a more complex shape.
- Overlapping buildings.
- Single polygon for multiple buildings in imagery.
- Single outer outline for buildings with inner atriums/courtyards instead of draw as multi-polygon.

If the only information in this dataset was the building outlines it would not be worth importing. But the address and height data make this worth the effort to spend on manually cleaning up each building.

#### Address Data

Spot checks of address data against areas with addresses gathered by walking about indicate that it is higher quality than the building outlines. But there are some issues that will need to be dealt with during import. Specifically:

- If there are more than one building on a parcel, all buildings have the same address. So, for example, a detached garage or yard shed will have address information on it.
- In some cases, a yard shed has the address for the adjacent property.
- In one case seen, there is an “off by one house” issue on numbering. This occurred where there was a vacant lot on the street.

#### Height Data

The height data has a ridiculous number of digits after the decimal place (e.g. 9.05253725 feet) implying a resolution that is impossible to have been measured.

#### Other Potential Issues

The above quality issues means that each house outline and address will need to be manually checked.

When editing an area, I have a tendency to become side tracked editing roads for surface, lanes, turn lanes, stop/yield locations, traffic lights, etc. This compulsion will need to be restrained so that each changeset only contains the imported data (as corrected).

## Preparation For Use

The scripts used in processing this data can be found on the [GitHub project for this import](https://github.com/n76/OSM_OC_Buildings).

### Conversion of SHP to OSM

- Open SHP file in JOSM (open data plug-in required).
- Create new OSM data layer in JOSM.
- Merge SHP layer into new OSM data layer.
- Save new data layer to local computer.
- Quit JOSM. **DO NOT UPLOAD THIS RAW DATA TO OSM!**
- Verify that "upload='false'" attribute is found in the ```<osm>``` tag. This should keep us for accidentally uploading this data.

### Translating and fixing attributes/tags
The field names and contents in the dataset are not directly compatible with OSM tagging conventions and need to be converted. Processing is as follows:

#### ABS_HT
There are 748,468 buildings with “absolute height” (i.e. elevation) data. It seems unwise to import this as, in general, OSM does not maintain elevation data. The exception in OSM would be significant landmarks, mountain peaks, etc. and these buildings are not in those categories.
- Remove tag and value.

#### ADDRESS
The house number and street name are in a single field with the street name all caps and with abbreviations for prefixes and suffixes.

- Split number from front of address. Create a new ['addr:housenumber'](https://wiki.openstreetmap.org/wiki/Key:addr) tag with the number as the value.
- Fix remaining value (street name).
    - Convert remaining value from upper case to capitalized words.
    - Expand abbreviated prefixes (e.g. 'E' to 'East').
    - Expand abbreviated suffixes (e.g. 'AV' and 'AVE' to 'Avenue').
- Fixed street name value tag will be ['addr:street'](https://wiki.openstreetmap.org/wiki/Key:addr).
- Remove 'ADDRESS' tag.

**Example:**
```
ADDRESS='2102 W GLEN AVE'
```
**becomes**
```
addr:housenumber='2102'
addr:street='West Glen Avenue'
```

#### CITY
The city name is in all caps.

- Convert value from upper case to capitalized words.
- Change tag from 'CITY' to ['addr:city'](https://wiki.openstreetmap.org/wiki/Key:addr).

**Example:**
```
CITY='ANAHEIM'
```
**becomes**
```
addr:city='Anaheim'
```

#### HEIGHT
Heights are in feet with microscopic precision implied by the number of digits after the decimal place.

- Convert value from feet to meters, round to 1 cm of precision.
- Change tag from 'HEIGHT' to ['height'](https://wiki.openstreetmap.org/wiki/Key:height).

**Example:**
```
HEIGHT='9.05253725'
```
**becomes**
```
height='2.76'
```

#### OBJECTID

These seem to be sequential numbers unique to the specific shape file and are unlikely to have value in referencing buildings or addresses.
- Remove tag and value.

#### ZIPCODE

- Change tag from 'ZIPCODE' to ['addr:postcode'](https://wiki.openstreetmap.org/wiki/Key:addr).

**Example:**
```
ZIPCODE='92801'
```
**becomes**
```
addr:postcode='92801'
```

#### Additional tags
The following tags will be added to all building polygons:

```
building=yes
```

### Script

The ```fixOCtags``` script reads a .osm file and looks for the above tags and replaces/adds tags and values as needed.

Usage:
```
./fixOCtags < Building_Footprints.osm > transformed.osm
```

## Areas to Import

Since each building will need to be be manually verified and corrected prior to uploading, the data set will be divided into chunks with the size picked to limit the amount of time needed to check and correct any single chunk.

### Chunk size

Looking at some representative areas it seems that a chunk size of 0.01° in latitude and longitude will limit the number of buildings per changeset to a reasonable number.

### Extracting a chunk

Dataset is too large for my computer to use ```osmsium``` to clip this data into small portions. And my computer and ```OsmConvert``` do not seem to be compatible. So a quick and dirty script that uses very little memory and has no external library requirements was written. Usage is straight forward:
```
./Extract -b -117.644,33.382,-117.555,33.491 -i transformed.osm -o extracted.osm
```
This script relies on the specific format that JOSM saves the OSM XML data and works on a line by line basis making two passes to extract the buildings within the specified area.

If any node on the building is within the boundary, then all nodes for that building are included. The result is that buildings on the boundary between two chunks will be in both chunks.

*Caution: Do not use this script on other datasets without verifying it will work properly. In addition to relying on the order of objects and line breaks used when exported from JOSM, this script does not handle relations, including multi-polygons, at all.*

A script that iterates over a bounding box that covers the whole county calls the above ```Extract``` script to generate separate files for each 0.01° chunk. Intended for a one-time use, the bounding box, input and output file names, etc. are hardcoded:

```
./chunkIt
```

This results in 4,440 OSM OSM formatted chunk files.

Since the county is not rectangular, a significant number of the extracted chunks are empty and are discarded after the script completes. This leaves (XXXX?) chunks to be imported.

## Importing a Chunk

Imports will be from the south end of the county to the north. The reason for this is the city I live in is the southern most city in the county and if this effort becomes too great, I’d like to at least get my city complete.

### User Identification

The user ID of 'n76_oc_import' will be used on all edits.

### Conflation ###

Conflation of data will be a manual operation assisted by the JOSM conflate plug-in.

1. Load a chunk file into JOSM.
2. Download current OSM data for that area into a new layer.
3. For each building in a chunk, verify and correct address data. Specifically:
    - Remove duplicate addresses from out buildings.
    - Verify that street names match with existing OSM street data.
    - If OSM data already has address tags, make sure that there is no “off by one house” situation.
4. In the chunk layer, find all buildings ```type:way building=*```
5. In the configure plug-in panel, click “configure” button and “freeze” selection as the “reference”.
6. In the OSM data layer, find all buildings ```type:way building=*```
7. In the configure plug-in panel, click “configure button” and “freeze” selection as the “subject”. Make sure “replace geometry” is unchecked (we are not replacing existing OSM building geometry). Click on “Generate Matches”.
8. Select a building by clicking on the it in the configuration plug-in’s list of matches.
    - Verify tag data seems correct.
    - Click on “conflate” button to update tags on existing OSM building.
9. Once all matches are conflated, click on the “reference only” tab on the conflate plug in to work with buildings not already in OSM.
    - Click on a building to select it.
    - Click on conflate button to copy the building into OSM.
    - Correct building geometry based on best available OSM compatible imagery.
10. Once all the buildings in a chunk have been conflated or imported, upload/commit the edit.

### Changesets

- Each change set will contain no more than one chunk of data. In some cases there may be more than one change set per chunk.
- Change set comment will be: ```Orange County buildings and addresses see https://wiki.openstreetmap.org/wiki/Orange_County_Building_and_Address_Import```
- Change set sources will be ```Orange County GIS;Bing Imagery``` (imagery attribution may vary depending on which OSM compatible imagery was used to correct building outlines).
