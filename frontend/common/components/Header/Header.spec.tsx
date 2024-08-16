import { render, screen, fireEvent } from "@testing-library/react";
import { Header } from "./Header.component";
import "@testing-library/jest-dom";
import { useApp } from "@/common/providers/AppProvider";

// Mock para o useApp
jest.mock("@/common/providers/AppProvider");

describe("<Header />", () => {
  beforeEach(() => {
    (useApp as jest.Mock).mockReturnValue({
      onDrawerToggle: jest.fn(),
    });
  });

  it("should render the title 'Livros'", () => {
    render(<Header />);
    const titleElement = screen.getByText((content, element) => element?.tagName.toLowerCase() === "h1" && content.includes("Livros"));
    expect(titleElement).toBeInTheDocument();
  });

  it("should render the Simbi button with correct href", () => {
    render(<Header />);
    const simbiButton = screen.getByRole("link", { name: /Simbi/i });
    expect(simbiButton).toBeInTheDocument();
    expect(simbiButton).toHaveAttribute("href", "https://www.simbi.social");
  });

  it("should call onDrawerToggle when menu button is clicked", () => {
    const { onDrawerToggle } = useApp();
    render(<Header />);
    const menuButton = screen.getByLabelText(/open drawer/i);
    fireEvent.click(menuButton);
    expect(onDrawerToggle).toHaveBeenCalledTimes(1);
  });

  it("should render the Notifications icon button", () => {
    render(<Header />);
    const notificationsButton = screen.getByLabelText(/alerts/i);
    expect(notificationsButton).toBeInTheDocument();
  });

  it("should render the 'Todos' tab", () => {
    render(<Header />);
    const todosTab = screen.getByText(/Todos/i);
    expect(todosTab).toBeInTheDocument();
  });
});
