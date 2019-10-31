import { Component, IFloatingFilter, IFloatingFilterParams } from "@ag-community/grid-core";
import { SetFilterModel } from "./setFilterModel";
export declare class SetFloatingFilterComp extends Component implements IFloatingFilter {
    private eFloatingFilterText;
    private valueFormatterService;
    private column;
    constructor();
    init(params: IFloatingFilterParams): void;
    onParentModelChanged(parentModel: SetFilterModel): void;
}