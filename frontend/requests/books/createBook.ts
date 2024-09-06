interface AddBookParams {
  title: string;
  authorId: string;
  publisher: string;
}

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
    return data;
  } catch (error) {
    console.error("Error creating book:", error);
  } 
}
