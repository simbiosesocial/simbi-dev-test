import { env } from "@/common/config/env";
import { Book } from "@/declarations";
import HomePageView from "@/views/HomePage";

async function getBooks(): Promise<Book[]> {
  const response = await fetch(`${env.API_URL}/api/books`, { next: { tags: ['books'] }});
  if (!response.ok) {
    throw new Error("Failed to fetch books", { cause: response.statusText });
  }
  const data: Book[] = await response.json();
  data.sort((a, b) => {
    if (a.isAvailable === b.isAvailable) {
      return a.title.localeCompare(b.title);
    }
    return a.isAvailable ? -1 : 1;
  });
  return data;
}

export default async function Home() {
  const books = await getBooks();

  return <HomePageView books={books} />;
}
