import os, requests
from os.path import exists

save_file_name = "BookURLs"

def setSaveFileName(filename):
    global save_file_name
    save_file_name = filename

def getCategoryFromHTML(HTML):
    CategoryPos = HTML.find("collection-title") + len("collection-title")
    CategoryHTML = HTML[CategoryPos:]
    CategoryPos = CategoryHTML.find("<div class=")
    CategoryHTML = CategoryHTML[:CategoryPos]
    CategoryHTML = CategoryHTML.replace(r"\n", "")
    CategoryHTML = CategoryHTML.replace("\\", "")
    CategoryHTML = CategoryHTML.replace(">", "")
    if CategoryHTML[0] == '"':
        CategoryHTML = CategoryHTML[1:]
    Category = CategoryHTML.strip()
    if Category.find("Trending eBooks about ") != -1:
        Category = Category[22:]
    return Category

def findMaxPageNum(HTML, category):
    global catnums
    pageNums = []
    PagesPos = HTML.find(f"category/{catnums[category]}/p") + len(f"category/{catnums[category]}/p")
    PagesHTML = HTML[PagesPos:]
    temp = PagesHTML[:PagesHTML.find("/")]
    pageNums.append(temp)
    while PagesHTML.find(f"category/{catnums[category]}/p") != -1:
        PagesPos = PagesHTML.find(f"category/{catnums[category]}/p") + len(f"category/{catnums[category]}/p")
        PagesHTML = PagesHTML[PagesPos:]
        temp = PagesHTML[:PagesHTML.find("/")]
        pageNums.append(temp)
    counter = 0
    while counter < len(pageNums):
        pageNums[counter] = int(pageNums[counter])
        counter += 1
    pageNums.sort()
    maxPageNum = pageNums[-1]
    return maxPageNum

def removeDuplicatesFromFile():
    global save_file_name
    with open(save_file_name) as file:
        lines = file.readlines()

    lines = dict.fromkeys(lines)

    BookURLsFile = open(save_file_name, "w")
    BookURLsFile.write("")
    BookURLsFile.close()

    BookURLsFile = open(save_file_name, "a")
    for line in lines:
        BookURLsFile.write(line)

    BookURLsFile.close()
    print(f"\nDuplicate lines removed from{save_file_name}")
    print("**Please check that the last line in the file is not a duplicate\n")

def GatherBookList():
    global catnums, save_file_name
    if exists(save_file_name):
        os.remove(save_file_name)
    BookURLsFile = open(save_file_name, "a")
    catnums = {
        'editorspicks': 113,
        'mostpopular': 112,
        'academiceducation': 6,
        'art': 1,
        'biography': 16,
        'businesscareer': 3,
        'childrenyouth': 17,
        'environment': 18,
        'healthfitness': 11,
        'fictionliterature': 8,
        'lifestyle': 19,
        'personalgrowth': 4,
        'politicslaw': 15,
        'religion': 10,
        'scienceresearch': 14,
        'technology': 5,
    }

    categories = []
    booksByCategories = []

    for category in catnums:
        BookURLs = []
        URL = f"https://www.pdfdrive.com/category/{catnums[category]}"
        page = requests.get(URL)
        HTML = str(page.content)
        Category = getCategoryFromHTML(HTML)
        categories.append(Category)
        maxPageNum = findMaxPageNum(HTML, category)
        # print(f"{Category}: Pages 1-{maxPageNum}")

        # print(f"{Category}:")
        BookURLsFile.write(f"{Category}\n")
        currentPage = maxPageNum
        while currentPage >= 1:
            print(f"\n{Category}: Page {currentPage}")
            URL = f"https://www.pdfdrive.com/category/{catnums[category]}/p{currentPage}/"
            requests.get(URL)
            page = requests.get(URL)
            HTML = str(page.content)
            while HTML.find("file-right") != -1:
                pos = HTML.find("file-right")
                temp = HTML[pos+23:]
                pos = temp.find(".html") + 5
                URL = f"http://pdfdrive.com{temp[:pos]}"
                HTML = HTML[HTML.find(".html") + 5:]
                BookURLs.append(URL)
            currentPage -= 1
            BookURLs = list(set(BookURLs))
            for x in BookURLs:
                if x.find("\\") == -1:
                    # print(x)
                    BookURLsFile.write(f"{x}\n")

    booksByCategories.append(BookURLs)
    BookURLsFile.close()
    removeDuplicatesFromFile()