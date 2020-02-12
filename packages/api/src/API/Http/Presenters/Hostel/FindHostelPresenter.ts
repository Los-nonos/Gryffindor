import IPresenter from '../Base/IPresenter';
import Hostel from '../../../../Domain/Entities/Hostel';

class FindHostelPresenter implements IPresenter {
  private result: Hostel[];
  constructor(result: any) {
    this.result = result;
  }
  public toJson(): string {
    return JSON.stringify(this.getData());
  }
  public getData(): object {
    const array = this.result.map(hostel => {
      return {
        id: hostel.Id,
        name: hostel.Name,
        address: hostel.Address,
        email: hostel.Email,
        cuit: hostel.Cuit,
        tinyDescription: hostel.TinyDescription,
      };
    });
    return {
      data: array,
    };
  }
}

export default FindHostelPresenter;
