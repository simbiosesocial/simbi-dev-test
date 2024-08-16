import { render, screen } from "@/common/utils/test-utils";
import { BookItem } from "./BookItem.component";
import { bookItem } from "./BookItem.mock";

describe("<BookItem />", () => {
  it("should render the title", () => {
    render(<BookItem {...bookItem} />);
    const titleElement = screen.getByText(bookItem.title);
    expect(titleElement).toBeInTheDocument();
  });

  it("should use the provided cover image", () => {
    const { debug } = render(<BookItem {...bookItem} />);
    const imageElement = screen.getByRole("img", { name: bookItem.title });
    expect(imageElement).toHaveAttribute("style", `background-image: url(${bookItem.coverUrl});`);
  });

  it("should use the default cover image when no coverUrl is provided", () => {
    render(<BookItem {...bookItem} coverUrl={undefined} />);
    const imageElement = screen.getByRole("img", { name: bookItem.title });
    expect(imageElement).toHaveAttribute("style", "background-image: url(/cover.png);");
  });

  it("should render the loan button", () => {
    render(<BookItem {...bookItem} />);
    const buttonElement = screen.getByRole("button", { name: /Empréstimo/i });
    expect(buttonElement).toBeInTheDocument();
  });

  it("should display the full title in a tooltip", async () => {
    render(<BookItem {...bookItem} />);
    const tooltipElement = screen.getByText(bookItem.title);
    expect(tooltipElement).toBeInTheDocument();
  });

  it("should render a description", () => {
    render(<BookItem {...bookItem} />);
    const descriptionElement = screen.getByText(/Lorem ipsum dolor sit amet, consectetur adipiscing elit./i);
    expect(descriptionElement).toBeInTheDocument();
  });
});
