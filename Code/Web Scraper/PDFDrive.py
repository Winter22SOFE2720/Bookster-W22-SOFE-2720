import PyPDF2, os, time, requests
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By

import DataBase
# URL_AltSite = "http://goodreads.com"

def scrapeBookURL(title, hideBrowser):
    PDFDrive_URL = "http://pdfdrive.com"
    seleBrowserPath = "C:\Program Files (x86)\chromedriver.exe"
    seleDriver = ""

    if (hideBrowser):
        chrome_options = Options()
        chrome_options.add_argument("--headless")
        seleDriver = webdriver.Chrome(seleBrowserPath, options=chrome_options)
    else:
        seleDriver = webdriver.Chrome(seleBrowserPath)

    seleDriver.get(PDFDrive_URL)
    time.sleep(5)

    seleLink = seleDriver.find_element(By.ID, "q")  #
    seleLink.send_keys(title)
    time.sleep(1)

    seleLink = seleDriver.find_element(By.XPATH, '//*[@id="search-form"]/button/i')
    seleLink.click()
    time.sleep(5)

    HTML = str(seleDriver.page_source.encode('utf-8'))
    pos = HTML.find("file-left")
    HTML = HTML[pos - 25:pos+250]
    pos = HTML.find('href="')
    HTML = HTML[pos + 6:]
    pos = HTML.find('"')
    PageURL = "https://www.pdfdrive.com" + HTML[:pos]
    print(PageURL)
    return PageURL


def scrapeBookPDF(BookPageURL, hideBrowser):
    PDFDrive_URL = "http://pdfdrive.com"
    seleBrowserPath = "C:\Program Files (x86)\chromedriver.exe"
    seleDriver = ""

    if (hideBrowser):
        chrome_options = Options()
        chrome_options.add_argument("--headless")
        seleDriver = webdriver.Chrome(seleBrowserPath, options=chrome_options)
    else:
        seleDriver = webdriver.Chrome(seleBrowserPath)

    seleDriver.get(BookPageURL)

    # download book (id: download-button-link for pdfdrive)
    seleLink = seleDriver.find_element(By.ID, "download-button-link")
    seleLink.click()
    time.sleep(30)

    # IF ' go to pdf ' on page
    pageHTML = str(seleDriver.page_source.encode('utf-8'))
    if pageHTML.find("Go to PDF") != -1:
        # save all info based off book site

        HTML = str(seleDriver.page_source.encode('utf-8'))  #
        pos = HTML.find("ebook-file-info")
        HTML = HTML[pos:pos+500]
        pos = HTML.find('<br>')
        EBookFileInfo = HTML[pos+4:]
        print(EBookFileInfo)

        # get book PDF URL
        HTML = str(seleDriver.page_source.encode('utf-8'))
        pos = HTML.find("Go to PDF")
        HTML = HTML[pos-250:pos]
        pos = HTML.find('href="')
        HTML = HTML[pos+6:]
        pos = HTML.find('"')
        BookURL = HTML[:pos]

        # create a new directory based off book_id

        # save the pdf into the new directory
        response = requests.get(BookURL)
        with open("myBook.pdf", 'wb') as f:
            f.write(response.content)
    else:
        print("go to pdf was not found on the page!")
    print("PDF has likely been downloaded..")
    seleDriver.close()

    filePathToPDF = "C:/bad/file/path/"
    print(f"WARNING: filePathToPDF has been set manually inside PDFDrive.py")
    print(f"{filePathToPDF}")

    return filePathToPDF

def createPreviewPDF(filePathToPDF, numPages):
    pdfWriter = PyPDF2.PdfFileWriter()
    pdfFileObj = open(filePathToPDF, 'rb')
    pdfReader = PyPDF2.PdfFileReader(pdfFileObj)
    for x in range(0, numPages):
        pageObj = pdfReader.getPage(x)
        pdfWriter.addPage(pageObj)
    with open(f"{filePathToPDF[:-4]}_preview.pdf", "wb") as output:
        pdfWriter.write(output)



# DataBase.SQLInsertBookInitial("test", "test", 1999, "test", "test", 19.7, 173, 0.5, 3, 1010, "test", "test")
# print(scrapeBookURL("One Indian Girl", False))  # returns URL of book page

