import { env } from "@/common/config/env";
import HomePageView from "@/views/HomePage";

async function getBooks(): Promise<Book[]> {
  const response = await fetch(`${env.API_URL}/api/books`);
  if (!response.ok) {
    throw new Error("Failed to fetch books", { cause: response.statusText });
  }
  return response.json();
}

export default async function Home() {
  const books = await getBooks();

  return <HomePageView books={books} />;
}
