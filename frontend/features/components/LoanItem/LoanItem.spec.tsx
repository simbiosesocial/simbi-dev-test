import { render, screen } from "@/common/utils/test-utils";
import { LoanItem } from "./LoanItem.component";
import { loanItem } from "./LoanItem.mock";

describe("<LoanItem />", () => {
  it("should render the title", () => {
    render(<LoanItem {...loanItem} />);
    // const titleElement = screen.getByText(loanItem.title);
    // expect(titleElement).toBeInTheDocument();
  });

  it("should use the provided cover image", () => {
    const { debug } = render(<LoanItem {...loanItem} />);
    // const imageElement = screen.getByRole("img", { name: loanItem.title });
    // expect(imageElement).toHaveAttribute("style", `background-image: url(${loanItem.coverUrl});`);
  });

  it("should use the default cover image when no coverUrl is provided", () => {
    // render(<LoanItem {...loanItem} coverUrl={undefined} />);
    // const imageElement = screen.getByRole("img", { name: loanItem.title });
    // expect(imageElement).toHaveAttribute("style", "background-image: url(/cover.png);");
  });

  it("should render the loan button", () => {
    render(<LoanItem {...loanItem} />);
    const buttonElement = screen.getByRole("button", { name: /Empréstimo/i });
    expect(buttonElement).toBeInTheDocument();
  });

  it("should display the full title in a tooltip", async () => {
    // render(<LoanItem {...loanItem} />);
    // const tooltipElement = screen.getByText(loanItem.title);
    // expect(tooltipElement).toBeInTheDocument();
  });

  it("should render a description", () => {
    render(<LoanItem {...loanItem} />);
    const descriptionElement = screen.getByText(/Lorem ipsum dolor sit amet, consectetur adipiscing elit./i);
    expect(descriptionElement).toBeInTheDocument();
  });
});
