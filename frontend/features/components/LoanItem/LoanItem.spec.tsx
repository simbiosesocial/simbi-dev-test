import { render, screen } from "@/common/utils/test-utils";
import { LoanItem } from "./LoanItem.component";
import { loanItem } from "./LoanItem.mock";

describe("<LoanItem />", () => {  
  it("should render the title", () => {
    render(<LoanItem {...loanItem} />);
    const titleElement = screen.getByText(loanItem.book.title);
    expect(titleElement).toBeInTheDocument();
  });

  it("should use the provided cover image", () => {
    const { debug } = render(<LoanItem { ...loanItem }/>);
    const imageElement = screen.getByRole("img", { name: loanItem.book.title });
    expect(imageElement).toHaveAttribute("style", `background-image: url(${loanItem.book.coverUrl});`);
  });

  it("should use the default cover image when no coverUrl is provided", () => {
    render(<LoanItem {...loanItem} book={{
      ...loanItem.book,
      coverUrl: undefined
    }}/>);
    const imageElement = screen.getByRole("img", { name: loanItem.book.title });
    expect(imageElement).toHaveAttribute("style", "background-image: url(/cover.png);");
  });

  it("should render the loan buttons", () => {
    render(<LoanItem {...loanItem} />);
    const renewButton = screen.getByRole("button", { name: /Renovar/i });
    expect(renewButton).toBeInTheDocument();

    const finalizeButton = screen.getByRole("button", { name: /Devolver/i });
    expect(finalizeButton).toBeInTheDocument();
  });

  it("should display the full title in a tooltip", async () => {
    render(<LoanItem {...loanItem} />);
    const tooltipElement = screen.getByText(loanItem.book.title);
    expect(tooltipElement).toBeInTheDocument();
  });
});
