<?php 
	
		/*Please visit each table schema carefully and check all the relational attributes are correct and available, if any attribute is absent/ not correct then please correct that attribute. Finally please make a comment beside the attribute declaration line only for primary key and foreign key. Thanks. Do this favour for me. Cause i'am not well knowledged about all requirements and relations between them. */
/*Schema::create('ArchivedBookBasicInfo', function (Blueprint $table) {
            $table->bigInteger('ABBINo'); //ABBINo is base table ID (Primary Key)??
            $table->bigInteger('bookID'); //foreign key
            $table->bigInteger('writingStartyearHijri');
            $table->bigInteger('writingStartyearIsae');
            $table->bigInteger('languageID');
        });

Schema::create('ArchivedBookBasicInfoConnectedBookLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo'); //this is a foreign key from ArchivedBookBasicInfo table??  
            $table->bigInteger('connectedBookID');
            $table->bigInteger('positionUp');
        }); */
/*Schema::create('ArchivedBookBasicInfoCoverPhotoLinkLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('SLNo');
            $table->text('coverPhotoLink');
        });*/

/*Schema::create('ArchivedBookBasicInfoIndexLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('SLNo');
            $table->text('indexText');
        });*/

/*Schema::create('ArchivedBookBasicInfoQuotationLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('SLNo');
            $table->text('quotation');
        });

Schema::create('ArchivedBookBasicInfoRefLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->text('ref');
        });

Schema::create('ArchivedBookBasicInfoReviewLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('reviewBookID');
            $table->text('review');
        });

Schema::create('ArchivedBookBasicInfoWritingPlaceLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('placeID');
            $table->string('timePeriodHijri');
            $table->string('timePeriodIsae');
        });*/

/*Schema::create('ArchivedBookManuscriptInfo', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('libraryID');
            $table->string('indexInLibrary')->nullable();
            $table->bigInteger('writerID');
            $table->bigInteger('writtenYearHijri')->nullable();
            $table->bigInteger('writtenYearIsae')->nullable();
            $table->bigInteger('pageCount')->nullable();
            $table->bigInteger('pageSizeID')->nullable();
            $table->bigInteger('lineCountPerPage')->nullable();
            $table->text('someStratingLine')->nullable();
            $table->text('someEndingLine')->nullable();
            $table->text('errors')->nullable();
            $table->text('description')->nullable();
            $table->text('pdfLink')->nullable();
        });*/

/*Schema::create('ArchivedBookPublishedInfo', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('publisherID');
        });

Schema::create('ArchivedBookPublishedInfoEditionLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('editionNo');
            $table->bigInteger('yearHijri')->nullable();
            $table->bigInteger('yearIsae')->nullable();
            $table->bigInteger('partCount');
            $table->bigInteger('pageCount');
            $table->bigInteger('pageSizeID')->nullable();
            $table->text('error')->nullable();
            $table->text('description')->nullable();
            $table->text('coverPhotoLink')->nullable();
            $table->text('pdfLink')->nullable();
        });

Schema::create('ArchivedBookPublishedInfoEditorLine', function (Blueprint $table) {
            $table->bigInteger('ABBINo');
            $table->bigInteger('editionNo');
            $table->bigInteger('editorID');
            $table->string('workCategory')->nullable();
            $table->text('description')->nullable();
        });*/

/*Schema::create('BookCategoryList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categoryName');
        });*/

/*Schema::create('BookList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('bookName');
            $table->bigInteger('bookCategoryID');
        });*/

/*Schema::create('CountryList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country');
        });

Schema::create('KuniadList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kuniadName');
        });

Schema::create('LanguageList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('language');
        });*/
/*
Schema::create('LibraryList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libraryName');
            $table->bigInteger('placeID')->nullable();
            $table->bigInteger('stablishedYearHijri')->nullable();
            $table->bigInteger('stablishedYearIsae')->nullable();
            $table->text('web')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkedIn')->nullable();
            $table->text('youtube')->nullable();
            $table->text('locationMapLink')->nullable();

        });*/

/*Schema::create('MazbabTypeList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mazhabType');
        });

Schema::create('MazhabList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mazhabName');
            $table->bigInteger('mazhabType');
        });

Schema::create('PersonCategoryList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('personCategory');
        });

Schema::create('PersonList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('personName');
            $table->string('surName')->nullable();
            $table->string('fathersName')->nullable();
            $table->bigInteger('birthYearHijri')->nullable();
            $table->bigInteger('birthYearIsae')->nullable();
            $table->bigInteger('birthPlaceID')->nullable();
            $table->bigInteger('deathPlaceID')->nullable();
            $table->bigInteger('deathYearHijri')->nullable();
            $table->bigInteger('deathYearIsae')->nullable();
            $table->bigInteger('Kuniad')->nullable();
            $table->bigInteger('mazhabFikih')->nullable();
            $table->bigInteger('mazhabAkidah')->nullable();
            $table->text('description')->nullable();
        });

Schema::create('PersonListbooksLine', function (Blueprint $table) {
           	$table->bigInteger('personID');
            $table->bigInteger('bookID');
        });

Schema::create('PersonListCatagoryLine', function (Blueprint $table) {
            $table->bigInteger('personID');
            $table->bigInteger('personCategoryId');
        });


Schema::create('PersonListFollowerLine', function (Blueprint $table) {
            $table->bigInteger('personID');
            $table->bigInteger('followerID');
        });

Schema::create('PersonListMentorLine', function (Blueprint $table) {
            $table->bigInteger('personID');
            $table->bigInteger('mentorID');
        });

Schema::create('PersonListQuotionLine', function (Blueprint $table) {
            $table->bigInteger('personID');
            $table->text('quotion');
        });

Schema::create('PersonListResidenceLine', function (Blueprint $table) {
            $table->bigInteger('personID');
            $table->bigInteger('ResidenceplaceID');
            $table->string('timePeriodHijri');
            $table->string('timePeriodIsae');
        });

Schema::create('PersonListStudentLine', function (Blueprint $table) {
            $table->bigInteger('personID');
            $table->bigInteger('studentID');
        });

Schema::create('PersonListUstadLine', function (Blueprint $table) {
            $table->bigInteger('personID');
            $table->bigInteger('UstadID');
        });
Schema::create('PlaceList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city');
            $table->bigInteger('countryID');
        });*/
/*Schema::create('PublisherList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('publisherName');
            $table->bigInteger('placeID')->nullable();
            $table->bigInteger('ownerID');
            $table->bigInteger('stablishedYearHijri')->nullable();
            $table->bigInteger('stablishedYearIsae')->nullable();
            $table->text('web')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkedIn')->nullable();
            $table->text('youtube')->nullable();
            $table->text('locationMapLink');
        });*/

/*Schema::create('SizeList', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('sizedescription');
        });*/
