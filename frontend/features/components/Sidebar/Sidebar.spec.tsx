import { render, screen } from "@/common/utils/test-utils";
import { Sidebar } from "./Sidebar.component";

describe("<Sidebar />", () => {
  it("renders Sidebar component", () => {
    render(<Sidebar />);
    expect(screen.getByTestId("sidebar")).toBeInTheDocument();
  });
});
