import PyPDF2, os, time, requests
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By

def findBooks():
    print("findBooks")

def getAddBookInfo(BookPageURL, hideBrowser):
    returnArray = []
    page = requests.get(BookPageURL)
    HTML = str(page.content)

    AuthorPos = HTML.find('by')
    AuthorHTML = HTML[AuthorPos+3:]
    AuthorPos = AuthorHTML.find('title')
    Author = AuthorHTML[:AuthorPos-2]
    returnArray.append(Author)

    RatingPos = HTML.find('ratingValue')
    Rating = int(round(float(HTML[RatingPos+17:RatingPos+21])))
    returnArray.append(Rating)

    DescriptPos = HTML.find('descriptionContainer')
    DescriptHTML = HTML[DescriptPos+157:]
    DescriptPos = DescriptHTML.find('id=')
    DescriptHTML = DescriptHTML[DescriptPos+54:]
    DescriptPos = DescriptHTML.find('</span>')
    DescriptHTML = DescriptHTML[:DescriptPos]
    DescriptHTML = DescriptHTML.replace("</em>", "")
    DescriptHTML = DescriptHTML.replace("<em>", "")
    Description = DescriptHTML.replace("\\", "")
    if Description[0] == ">":
        Description = Description[1:]
    returnArray.append(Description)


    PublisherPos = HTML.find('Published')
    PublisherHTML = HTML[PublisherPos+51:]
    PublisherPos = PublisherHTML.find('<nobr')
    Publisher = PublisherHTML[:PublisherPos-16]
    returnArray.append(Publisher)

    ISBNPos = HTML.find('ISBN13')
    ISBN = HTML[ISBNPos+32:ISBNPos+45]
    returnArray.append(ISBN)

    title = "The Making of Life of Pi"
    print(f"WARNING: title has been set manually inside GoodReads.py")
    print(f"{title}")

    seleBrowserPath = "C:\Program Files (x86)\chromedriver.exe"
    seleDriver = ""

    if (hideBrowser):
        chrome_options = Options()
        chrome_options.add_argument("--headless")
        seleDriver = webdriver.Chrome(seleBrowserPath, options=chrome_options)
    else:
        seleDriver = webdriver.Chrome(seleBrowserPath)

    seleDriver.get("https://www.amazon.ca/")
    seleLink = seleDriver.find_element(By.ID, "twotabsearchtextbox")
    seleLink.send_keys(title)
    seleLink = seleDriver.find_element(By.ID, "nav-search-submit-button")
    seleLink.click()
    time.sleep(5)

    HTML = str(seleDriver.page_source.encode('utf-8'))
    PricePos = HTML.find("a-offscreen")
    HardCoverPos = HTML.find("Hardcover")
    KindleEditionPos = HTML.find("Kindle Edition")
    priceType = 'Hardcover' if HardCoverPos < KindleEditionPos else 'eBook'
    Price = float(HTML[PricePos+14:PricePos+19])
    if priceType == "eBook":
        # print("Converted ebook price into hardcover price with a multiplier of two")
        Price = Price*2
    returnArray.append(Price)

    print("Grabbed data from GoodReads")
    return returnArray

