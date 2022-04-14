from os.path import exists

import BooksList
import GoodReads
import PDFDrive
import DataBase

# PROGRAM SETTINGS
hideBrowser = True
save_file_name = "BookURLs"
numPagesForPDFPreviews = 20
minRandomizedDiscountPercent = 0
maxRandomizedDiscountPercent = 20

BooksList.setSaveFileName("BookURLs")

def scrapeBookData():
    print("Run the scraper on BookURLs obtain book PDF's and book data")

    BookURLsFile = open(save_file_name, 'r')
    Lines = BookURLsFile.readlines()

    category = None
    subBooks = []

    for line in Lines:
        if line.strip().find(".com") == -1:
            category = line.strip()
            print(category)
        elif line.strip().find(".com") != -1:
            subBooks = []
            subBooks.append(line.strip())
            print(subBooks)
    BookURLsFile.close()


# # ONE scrape goodreads for books
# print("<1> scrape goodreads for books")
# GoodReads.findBooks()

# # TWO scrape PDFDrive to find the book
# print("<2> scrape PDFDrive to find the book")
# BookPageURL = PDFDrive.scrapeBookURL("One Indian Girl", hideBrowser)  # returns URL of book page

# # THREE scrape the book from PDFDrive
# print("<3> scrape the book from PDFDrive")
# filePathToPDF = PDFDrive.scrapeBookPDF(BookPageURL, hideBrowser)  # have this return the filepath of the PDF

# FOUR truncate PDF past x=20 pages
# print("<4> truncate PDF for book preview file")
# filePathToPDF = "myBook.pdf"
# PDFDrive.createPreviewPDF(filePathToPDF, numPagesForPDFPreviews)

# get secondary info based off good reads
# delete database record if all fields are not populated

# scrapeArray = GoodReads.getAddBookInfo("https://www.goodreads.com/book/show/15819345-the-making-of-life-of-pi", hideBrowser)
# for x in scrapeArray:
#     print(x)

# BooksList.GatherBookList()

# bookArray = ParseBookList()
# print(len(bookArray))


if exists(save_file_name):
    scrapeBookData()
else:
    print(f"Scraping PDFDrive.com to create a list of BookURL's in file {save_file_name}")
    BooksList.GatherBookList()
