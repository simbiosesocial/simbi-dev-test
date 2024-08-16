import { render, screen } from "@/common/utils/test-utils";
import { BooksList } from "./BooksList.component";
import { booksList } from "./BooksList.mock";

const books = booksList.books;

describe("<BooksList />", () => {
  it("renders BooksList component", () => {
    render(<BooksList {...booksList} />);

    expect(screen.getByText(books[0].title)).toBeInTheDocument();
    expect(screen.getByText(books[1].title)).toBeInTheDocument();
  });
});
