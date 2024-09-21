import { env } from "@/common/config/env";
import LoanPage from "@/views/LoanPage"

async function getBooks(): Promise<Book[]> {
  const response = await fetch(`${env.API_URL}/api/books`);
  if (!response.ok) {
    throw new Error("Failed to fetch books", { cause: response.statusText });
  }
  return response.json();
}

export default async function Form() {
  const books = await getBooks();

  return (
      <LoanPage books={books}/>
  );
};
