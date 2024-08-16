import { render, screen } from "@/common/utils/test-utils";
import { Copyright } from "./Copyright.component";

describe("<Copyright />", () => {
  it("should render the correct text", () => {
    render(<Copyright />);
    const linkElement = screen.getByText(/Simbi/i);
    expect(linkElement).toBeInTheDocument();
  });

  it("should render the link with the correct href", () => {
    render(<Copyright />);
    const linkElement = screen.getByRole("link", { name: /Simbi/i });
    expect(linkElement).toHaveAttribute("href", "https://simbi.social/");
  });
});
