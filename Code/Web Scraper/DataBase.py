import time
import mysql.connector

sqlPass = "sql$12345"
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password=sqlPass,  # configure above
    database="bookster_db"
)
mycursor = mydb.cursor()


def SQLSelectColumnByName(table_name, column_name):
    global mydb, mycursor
    # "SELECT {column_name} FROM {table_name} WHERE {target_column} = {str(target_value)}"
    mycursor.execute(f"SELECT {column_name} FROM {table_name}")
    myresult = mycursor.fetchall()
    return myresult


def SQLSelectRowByColVal(table_name, col_name, col_val):
    global mydb, mycursor
    mycursor.execute(f"SELECT * FROM {table_name} WHERE {col_name} = {str(col_val)}")
    myresult = mycursor.fetchone()
    return myresult


def SQLClearTable(table_name):
    confirmation = input(f"Enter SQL password to delete {table_name} table: ")
    if confirmation != sqlPass:
        return
    sql_clearHotels = f"DELETE FROM {table_name};"
    mycursor.execute(sql_clearHotels)
    mydb.commit()
    print(f"Data in database's {table_name} table has been CLEARED!")


def SQLInsertBookInitial(name, author, year, description, publisher, hard_price, hard_quantity, discount_rate, average_rating, ISBN, book_format, languages):
  SQL_insertJob = "INSERT INTO books (name, author, year, description, publisher, hard_price, hard_quantity, discount_rate, average_rating, ISBN, book_format, languages) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
  book_vals = (name, author, year, description, publisher, hard_price, hard_quantity, discount_rate, average_rating, ISBN, book_format, languages)
  mycursor.execute(SQL_insertJob, book_vals)
  mydb.commit()
  print(f"New Book:\n"
        f"name={name}\n"
        f"author={author}\n"
        f"year={year}\n"
        f"description={description}\n"
        f"publisher={publisher}\n"
        f"hard_price={hard_price}\n"
        f"hard_quantity={hard_quantity}\n"
        f"discount_rate={discount_rate}\n"
        f"average_rating={average_rating}\n"
        f"ISBN={ISBN}\n"
        f"book_format={book_format}\n"
        f"languages={languages}\n")
  time.sleep(0.05)
