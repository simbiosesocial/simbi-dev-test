interface AddBookParams {
  title: string;
  authorId: string;
  publisher: string;
}

export const fetchBookInfo = async (ISBN: string): Promise<any> => {
    try {
      // `https://openlibrary.org/search.json?q=${ISBN}`
      // `https://openlibrary.org/api/books?bibkeys=ISBN:${ISBN}&jscmd=details&format=json`
      const response = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${ISBN}`, {
        method: 'GET',
      });
      if(response.ok){
        const data = await response.json();
        console.log('data book', data);
        return data;
      }
    } catch (error) {
      console.error('Error fetching book info:', error);
    }
  };

export const createBook = async (bookData: AddBookParams): Promise<Book | undefined> => {
  try {
    const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/books`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(bookData),
    });
    if (!response.ok) {
      throw new Error("Failed to create book", { cause: response.statusText });
    }
    const data = await response.json();
    console.log("CREATE BOOK", data);
    return data;
  } catch (error) {
    console.error("Error creating book:", error);
  } 
}
