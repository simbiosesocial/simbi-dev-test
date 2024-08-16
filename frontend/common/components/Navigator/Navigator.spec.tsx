import { render, screen } from "@testing-library/react";
import { Navigator } from "./Navigator.component";
import { categories } from "./Navigator.consts";

describe("<Navigator />", () => {
  it("should render the title 'Simbi'", () => {
    render(<Navigator />);
    const titleElement = screen.getByText(/Simbi/i);
    expect(titleElement).toBeInTheDocument();
  });

  it("should render the 'Overview' section", () => {
    render(<Navigator />);
    const overviewElement = screen.getByText(/Overview/i);
    expect(overviewElement).toBeInTheDocument();
  });

  it("should render all category headers", () => {
    render(<Navigator />);
    categories.forEach((category) => {
      const categoryElement = screen.getByText(category.id);
      expect(categoryElement).toBeInTheDocument();
    });
  });

  it("should render all category children", () => {
    render(<Navigator />);
    categories.forEach((category) => {
      category.children.forEach((child) => {
        const childElement = screen.getByText(child.id);
        expect(childElement).toBeInTheDocument();
      });
    });
  });

  it("should highlight active category children", () => {
    render(<Navigator />);

    const activeChild = categories.flatMap((category) => category.children).find((child) => child.active);

    if (activeChild) {
      const activeElement = screen.getByText(activeChild.id);

      // Verifica se o próprio elemento possui a classe "Mui-selected"
      expect(activeElement).toBeTruthy();
      expect(activeElement.closest(".Mui-selected")).toBeInTheDocument();
    }
  });
});
